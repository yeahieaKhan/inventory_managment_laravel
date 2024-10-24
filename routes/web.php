<?php

use App\Http\Controllers\UserContorller;
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
    return view('welcome');
});

Route::post('/sohag',[UserContorller::class, 'UserResigtation']);
Route::post('/user-login',[UserContorller::class, 'UserLogin']);