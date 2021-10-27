<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])
    ->name('user.index');

Route::get('users/{id}', [UserController::class, 'show'])
    ->where(['id' => '[0-9]+'])
    ->name('user.show');

Route::post('users/{id}', [UserController::class, 'update'])
    ->where(['id' => '[0-9]+'])
    ->name('user.update');

Route::get('/users', function() {
        return view('partials.user.store');
    })->name('user.new');

Route::post('/users', [UserController::class, 'store'])
    ->name('user.store');

Route::post('{id}', [UserController::class, 'destroy'])
    ->where(['id' => '[0-9]+'])
    ->name('user.destroy');

Route::post('import', [UserController::class, 'import']);

Route::get('users/sort/{field}/{direction}', [UserController::class, 'sortBy'])
    ->name('user.sortby');
