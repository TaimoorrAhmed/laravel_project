<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::patch('update',  ['as' => 'users.update', 'uses' => 'UserController@update']);
//Route::post('/update','\App\Http\Controllers\UserController@update');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'update'])->name('update');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

