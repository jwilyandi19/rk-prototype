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

//Main Route
Route::get('/', 'DashboardController@index');

//Auth Routes
Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@doLogin');
Route::get('/logout', 'AuthController@logout');
Route::get('/register', 'AuthController@register');
Route::post('/register', 'AuthController@doRegister');


Route::get('/kelas', 'KelasController@index');
Route::post('/kelas', 'KelasController@doFind');
Route::get('/buat-kelas', 'KelasController@create');
Route::post('/buat-kelas', 'KelasController@doCreate');
Route::get('/kelas/{kodeKelas}', 'KelasController@view');
Route::get('/kelas/{kodeKelas}/ubah', 'KelasController@update');
Route::post('/kelas/{kodeKelas}/ubah', 'KelasController@doUpdate');
Route::get('/kelas/{kodeKelas}/hapus', 'KelasController@delete');
Route::post('/kelas/{kodeKelas}/hapus', 'KelasController@doDelete');
Route::get('/kelas/{kodeKelas}/enroll', 'KelasController@enroll');
Route::post('/kelas/{kodeKelas}/enroll', 'KelasController@doEnroll');
Route::get('/kelas/{kodeKelas}/expell', 'KelasController@expell');
Route::post('/kelas/{kodeKelas}/expell', 'KelasController@doExpell');


//Tugas Routes
Route::get('/kelas/{kodeKelas}/tugas/{kodeTugas}', 'TugasController@getAllTugas');
Route::post('/kelas/{kodeKelas}/tugas/{kodeTugas}', 'TugasController@submitTugas');
Route::post('/kelas/{kodeKelas}/penugasan/', 'TugasController@uploadPenugasan');

Route::get('/kelas/{kodeKelas}/materi', 'MateriController@index');
Route::get('/kelas/{kodeKelas}/materi/{id}','MateriController@view');

//Auth Routes
Route::post('/auth','AuthController@index')->name('auth.index');


