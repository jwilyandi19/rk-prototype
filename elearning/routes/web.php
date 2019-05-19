<?php
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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth Routes
Route::get('/login', 'AuthController@loginIndex');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/register', 'AuthController@registerIndex');
Route::post('/register', 'AuthController@register');
Route::get('/','AuthController@index')->name('auth.index');
Route::get('/login','AuthController@login')->name('auth.login');
Route::get('/logout','AuthController@logout')->name('auth.index');
Route::post('auth/','AuthController@index')->name('auth.index');
Route::resource('materis', 'MateriController');


