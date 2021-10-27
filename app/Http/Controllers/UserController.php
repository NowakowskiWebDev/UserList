<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProfile;
use App\Http\Requests\UpdateUserProfile;
use App\Imports\UsersImport;
use App\Repository\UserRepository;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->allPaginated(10);

        return view('partials.user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view ('partials.user.show', [
            'user' => $this->userRepository->get($id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUserProfile $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserProfile $request)
    {
        $data = $request->validated();

        $user = $this->userRepository->store($data);

        return view('partials.user.show', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUserProfile $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfile $request, $id)
    {
        $user = $this->userRepository->get($id);
        $data = $request->validated();

        $this->userRepository->updateModel($user, $data);

        return view('partials.user.show', [
            'user' => $this->userRepository->get($id),
            'success' => true,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = (int) $id;
        $this->userRepository->destroy($userId);

        return redirect()->back()->with('confirmDelete', 'User is delete!');
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));

        return redirect()
            ->route('user.index');
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sortBy($field, $direction)
    {
        $users = $this->userRepository->sortPaginated($field, $direction, 10);

        return view('partials.user.index', [
            'users' => $users,
        ]);
    }
}
