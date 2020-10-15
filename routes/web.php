<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@redir')->name('redir');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');#->middleware('permission:cargarPersonal');

Route::get('cargarpaciente', 'App\Http\Controllers\PagesController@cargarpaciente')->name('cargarpaciente')->middleware('auth');
Route::get('cargarpaciente2', 'App\Http\Controllers\PagesController@cargarpaciente2')->name('cargarpaciente2')->middleware('auth');
Route::get('cargarpaciente3', 'App\Http\Controllers\PagesController@cargarpaciente3')->name('cargarpaciente3')->middleware('auth');

Route::get('administrarsistema/{id}', 'App\Http\Controllers\PagesController@administrarsistema')->name('administrarsistema')->middleware('auth');
Route::get('crearsala/{idSistema}', 'App\Http\Controllers\PagesController@crearsala')->name('crearsala')->middleware('auth');

Route::get('listarpersonal', 'App\Http\Controllers\PagesController@listarpersonal')->name('listarpersonal')->middleware('auth');
Route::get('/editarpersonal/{id}', 'App\Http\Controllers\PagesController@editarpersonal')->name('editarpersonal')->middleware('auth');
Route::put('/actualizarusuario/{id}', 'App\Http\Controllers\PagesController@actualizarusuario')->name('actualizarusuario')->middleware('auth');
Route::delete('/eliminarusuario/{id}', 'App\Http\Controllers\PagesController@eliminarusuario')->name('eliminarusuario')->middleware('auth');

Route::delete('/eliminarsala/{id}', 'App\Http\Controllers\PagesController@eliminarsala')->name('eliminarsala')->middleware('auth');
Route::get('/editarsala/{id}', 'App\Http\Controllers\PagesController@editarsala')->name('editarsala')->middleware('auth');
Route::put('/actualizarsala/{id}', 'App\Http\Controllers\PagesController@actualizarsala')->name('actualizarsala')->middleware('auth');






