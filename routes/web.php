<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index']);

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::get('/register', [UserController::class, 'register']);

Route::post('/register', [UserController::class, 'store']);

Route::post('/auth', [UserController::class, 'auth']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::post('/post/create', [PostController::class, 'store'])->middleware('auth');

Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->middleware('auth');
