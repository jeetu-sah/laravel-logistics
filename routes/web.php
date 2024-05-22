<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AdminAuth;

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

Route::get('/', 'Auth\LoginController@index');

Route::group(['middleware'=>['auth']] , function(){
    /*Manage customer routes*/
});

Route::get('/', function () {
    return view('login/login');
});
Route::get('/', [LoginController::class, 'index']);
Route::post('admin/check-login', [LoginController::class, 'store']);
