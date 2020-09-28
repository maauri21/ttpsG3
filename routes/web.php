<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@redir')->name('redir');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');#->middleware('permission:cargarPersonal');

Route::get('cargarpaciente', 'App\Http\Controllers\PagesController@cargarpaciente')->name('cargarpaciente');
Route::get('cargarpaciente2', 'App\Http\Controllers\PagesController@cargarpaciente2')->name('cargarpaciente2');
Route::get('cargarpaciente3', 'App\Http\Controllers\PagesController@cargarpaciente3')->name('cargarpaciente3');

Route::get('administrarsistema', 'App\Http\Controllers\PagesController@administrarsistema')->name('administrarsistema');
Route::get('administrarsala', 'App\Http\Controllers\PagesController@administrarsala')->name('administrarsala');
Route::get('crearsala/{idSistema}', 'App\Http\Controllers\PagesController@crearsala')->name('crearsala');