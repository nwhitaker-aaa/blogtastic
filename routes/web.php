<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');

Route::resource('roles', RoleController::class);
