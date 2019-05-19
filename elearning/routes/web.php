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


Route::get('/kelas', 'KelasController@index');
Route::get('/kelas/{kodeKelas}', 'KelasController@view');
Route::get('/kelas/{kodeKelas}/edit', 'KelasController@edit');
Route::get('/kelas/{kodeKelas}/hapus', 'KelasController@delete');
Route::get('/kelas/{kodeKelas}/tugas/{kodeTugas}', 'TugasController@getAllTugas');
Route::post('/kelas/{kodeKelas}/tugas/{kodeTugas}', 'TugasController@submitTugas');
Route::post('/kelas/{kodeKelas}/penugasan/{penugasan}', 'TugasController@uploadPenugasan');
Route::get('/kelas/{kodeKelas}/materi', 'MateriController');
Route::get('/kelas/{kodeKelas}/materi/{id}','MateriController');

//Auth Routes
Route::post('auth/','AuthController@index')->name('auth.index');


