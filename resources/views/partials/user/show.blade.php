@extends('layout.main')

@section('content')
<div class="d-flex justify-content-center mt-5 user-profile">
    <div class="card">
        @isset($success)
            <div class="alert alert-success" role="alert">
                <strong>Profile is updated!</strong>
            </div>
        @endisset

        <div class="card-body">
            <img src="{{ URL::to('/img/avatar.png') }}" class="user-profile__avatar m-auto d-block rounded-circle">

            <ul class="user-profile__list list-unstyled">
                <li class="user-profile__item d-flex justify-content-between p-2"><strong>Name:</strong> <span>{{ $user->first_name }}</span></li>
                <li class="user-profile__item d-flex justify-content-between p-2"><strong>Surname:</strong> <span>{{ $user->last_name }}</span></li>
                <li class="user-profile__item d-flex justify-content-between p-2"><strong>Birthdate:</strong> <span>{{ $user->birthdate }}</span></li>
                <li class="user-profile__item d-flex justify-content-between p-2"><strong>Height:</strong> <span>{!! Helper::division($user->height, 10) !!}</span></li>
                <li class="user-profile__item d-flex justify-content-between p-2"><strong>Club member:</strong> <img src="{{ $user->club_member ? URL::to('/img/check-mark.svg') : URL::to('/img/cross.svg') }}" class="user-profile__club-icon"></li>
            </ul>

            <div class="border-top">
                <a class="btn btn-outline-secondary btn-sm m-2" href="{{ route('user.index') }}">Homepage</a>
                <button class="btn btn-outline-secondary btn-sm btn--edition" href="">Edition</button>
                <button class="d-none btn btn-outline-success btn-sm" href="">Save</button>
            </div>

            <div class="user-profile__form-edit hide">
                <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- X-XSRF-TOKEN -->

                    <div class="form-group mt-2">

                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                        />
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label for="surname">Surname</label>
                        <input
                            type="text"
                            class="form-control @error('surname') is-invalid @enderror"
                            id="surname"
                            name="surname"
                        >
                        @error('surname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group d-flex flex-column my-1">
                        <label class="mb-1" for="birthdate">Birthdate</label>
                        <input
                            type="date"
                            class="w-50 @error('birthdate') is-invalid @enderror"
                            id="birthdate"
                            name="birthdate"
                        >
                        @error('birthdate')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label for="height">Height</label>
                        <input
                            type="number"
                            step="0.1"
                            min="50"
                            max="250"
                            class="form-control @error('height') is-invalid @enderror"
                            id="height"
                            name="height"
                        >
                        @error('height')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p class="my-2">Club member</p>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="club_member" id="flexRadioDefault1" value="true">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Yes
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="club_member" id="flexRadioDefault2" value="false" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                No
                            </label>
                        </div>

                        @error('club_member')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
