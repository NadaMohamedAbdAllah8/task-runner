<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('user.pages.auth.register');
});

Route::post('/register-user', [UserController::class, 'register'])
    ->name('register-user');

Route::get('login', function () {
    return view('user.pages.auth.login');
});

Route::post('/login-user', [UserController::class, 'login'])->name('login-user');

Route::group(['middleware' => ['auth:user']], function () {
    Route::post('/logout-user', [UserController::class, 'logout']);

    Route::group(['prefix' => 'task', 'as' => 'task.'], function () {
        Route::get('create', [TaskController::class, 'create'])->name('create');
        //'TaskController@create');
        Route::get('store', [TaskController::class, 'store']);
    });
});