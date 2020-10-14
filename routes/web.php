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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
<<<<<<< Updated upstream
=======

Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');#->middleware('permission:cargarPersonal');

Route::get('cargarpaciente', 'App\Http\Controllers\PagesController@cargarpaciente')->name('cargarpaciente');
Route::get('cargarpaciente2', 'App\Http\Controllers\PagesController@cargarpaciente2')->name('cargarpaciente2');
Route::get('cargarpaciente3', 'App\Http\Controllers\PagesController@cargarpaciente3')->name('cargarpaciente3');

Route::get('administrarsistema', 'App\Http\Controllers\PagesController@administrarsistema')->name('administrarsistema');
Route::get('administrarsala', 'App\Http\Controllers\PagesController@administrarsala')->name('administrarsala');
Route::get('crearsala/{idSistema}', 'App\Http\Controllers\PagesController@crearsala')->name('crearsala');

Route::get('listarusuarios', 'App\Http\Controllers\PagesController@listarusuarios')->name('listarusuarios');
Route::get('/verdetalle/{id}', 'App\Http\Controllers\PagesController@verdetalle')->name('verdetalle');
Route::get('/editorusuario/{id}', 'App\Http\Controllers\PagesController@editorusuario')->name('editorusuario');

Route::put('/actualizarusuario/{id}', 'App\Http\Controllers\PagesController@actualizarusuario')->name('actualizarusuario');
Route::delete('/eliminarusuario/{id}', 'App\Http\Controllers\PagesController@eliminarusuario')->name('eliminarusuario');
Route::delete('/eliminarsala/{id}', 'App\Http\Controllers\PagesController@eliminarsala')->name('eliminarsala');

Route::get('/editarsala/{id}', 'App\Http\Controllers\PagesController@editarsala')->name('editarsala');
Route::put('/actualizarsala/{id}', 'App\Http\Controllers\PagesController@actualizarsala')->name('actualizarsala');






>>>>>>> Stashed changes
