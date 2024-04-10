<?php

use App\Http\Controllers\Admin\
{Auth\LoginController, BlogController, RoleController, UserController};
use Illuminate\Support\Facades\Route;

Route::get('/', [ LoginController::class, 'authenticate' ])->name('admin.home.index');
Route::get('/logout', [ LoginController::class, 'logout' ])->name('admin.logout');

Route::group([
    'middleware' => ['auth'],
], function () {
    Route::group(['middleware' => ['can:blogs']], function () {
        Route::resource('/blogs', BlogController::class,
            ['names' => [
                'index' => 'admin.blogs',
                'create' => 'admin.blogs.create',
                'store' => 'admin.blogs.store',
            ],
                'except' => ['show', 'edit', 'update', 'destroy']
            ]);

        Route::get('/blogs/{id}/index.html', [BlogController::class, 'edit'])->name('admin.blogs.edit');
        Route::put('/blogs/{id}/index.html', [BlogController::class, 'update'])->name('admin.blogs.update');
        Route::get('/blogs/{id}/delete/{permanent?}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');
        Route::get('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('admin.blogs.restore');
    });

    Route::group(['middleware' => ['can:users']], function () {
        Route::resource('/users', UserController::class,
            ['names' => [
                'index' => 'admin.users',
                'create' => 'admin.users.create',
                'store' => 'admin.users.store',
            ],
                'except' => ['show', 'edit', 'update', 'destroy']
            ]);

        Route::get('/users/{id}/index.html', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}/index.html', [UserController::class, 'update'])->name('admin.users.update');
        Route::get('/users/{id}/delete/{permanent?}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/users/{id}/restore', [UserController::class, 'restore'])->name('admin.users.restore');
    });

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});
