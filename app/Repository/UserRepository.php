<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function updateModel(User $user, array $data): void
    {
        $user->first_name = $data['name'] ?? $user->first_name;
        $user->last_name = $data['surname'] ?? $user->last_name;
        $user->birthdate = $data['birthdate'] ?? $user->birthdate;
        $user->height = $data['height'] ?? $user->height;
        $user->club_member = $data['club_member'] === 'true';

        $user->save();
    }

    public function store(array $data): User
    {

        $user = User::create([
            'first_name' => $data['name'],
            'last_name' => $data['surname'],
            'birthdate' => $data['birthdate'],
            'height' => $data['height'],
            'club_member' => $data['club_member'] === 'true',
        ]);

        return $user;

    }

    public function sortPaginated(string $by, string $direction, int $limit)
    {
        return $this->userModel->orderBy($by, $direction)->simplePaginate($limit);
    }

    public function allPaginated(int $limit)
    {
        return $this->userModel->simplePaginate($limit);
    }

    public function get(int $id)
    {
        return $this->userModel->find($id);
    }

    public function destroy(int $id)
    {
        $user = $this->userModel->find($id);
        $user->delete();
    }
}
