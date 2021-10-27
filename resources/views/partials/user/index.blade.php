@extends('layout.main')

@section('content')
    <div class="container my-5">
        <h1 class="fs-5 fw-bold text-center">List of Users</h1>

        <div class="d-flex my-2">
            <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Import Data
            </button>
            <a class="btn btn-primary" href="{{ route('user.new') }}">Add User</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @isset($successDeleted)
            <div class="alert alert-success" role="alert">
                <strong>Profile is deleted!</strong>
            </div>
        @endisset

        @if ($users->count())
            <div class="row">
                <table class="table">
                    <thead>
                     @if (\Session::has('confirmDelete'))
                        <div class="alert alert-danger">
                                <p>{!! \Session::get('confirmDelete') !!}</p>
                        </div>
                    @endif
                        <tr>
                            <th scope="col">
                                <a href="{{ route('user.sortby', [
                                    'field' => 'id',
                                    'direction' => 'asc',
                                ]) }}" class="text-decoration-none">Order number
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                                        <path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z"/>
                                    </svg>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('user.sortby', [
                                    'field' => 'first_name',
                                    'direction' => 'asc',
                                ]) }}" class="text-decoration-none">First name
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                                        <path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z"/>
                                    </svg>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('user.sortby', [
                                    'field' => 'last_name',
                                    'direction' => 'asc',
                                ]) }}" class="text-decoration-none">Last name
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                                        <path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z"/>
                                    </svg>
                                </a>
                            </th>
                            <th scope="col">Details</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['first_name'] }}</td>
                                <td>{{ $user['last_name'] }}</td>
                                <td>
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('user.show', ['id' => $user['id']]) }}">Show</a>
                                </td>
                                <td>
                                    <form class="float-right m-0" method="post" action="{{ route('user.destroy', ['id' => $user['id']]) }}">
                                        @csrf
                                        <div class="form-row">
                                            <input type="hidden" name="userId" value="{{ $user['id'] }}">
                                            <button type="submit" class="btn btn-danger mb-2">Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        @else
            @component('components.empty-csv')
            @endcomponent
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="file" name="file" class="form-control">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
