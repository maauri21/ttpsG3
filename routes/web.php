<?php

use Illuminate\Support\Facades\Route;

# Index
Route::get('/', 'App\Http\Controllers\HomeController@redir')->name('redir');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

# Sistema
Route::get('sistema/{id}', 'App\Http\Controllers\SistemaController@administrarsistema')->name('administrarsistema')->middleware('auth');
Route::get('cambio_obito/{id}', 'App\Http\Controllers\SistemaController@cambio_obito')->name('cambio_obito')->middleware('auth');
Route::get('cambio_egreso/{id}/{tipo}', 'App\Http\Controllers\SistemaController@cambio_egreso')->name('cambio_egreso')->middleware('auth');
Route::get('cambio_uti/{id}', 'App\Http\Controllers\SistemaController@cambio_uti')->name('cambio_uti')->middleware('auth');
Route::get('cambio_pc/{id}', 'App\Http\Controllers\SistemaController@cambio_pc')->name('cambio_pc')->middleware('auth');
Route::get('cambio_hotel/{id}', 'App\Http\Controllers\SistemaController@cambio_hotel')->name('cambio_hotel')->middleware('auth');
Route::get('cambio_domicilio/{id}', 'App\Http\Controllers\SistemaController@cambio_domicilio')->name('cambio_domicilio')->middleware('auth');

# Personal
Route::get('personal', 'App\Http\Controllers\PersonalController@administrarpersonal')->name('administrarpersonal')->middleware('auth');
Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');#->middleware('permission:cargarPersonal');
Route::get('/editarpersonal/{id}', 'App\Http\Controllers\PersonalController@editarpersonal')->name('editarpersonal')->middleware('auth');
Route::put('/actualizarpersonal/{id}', 'App\Http\Controllers\PersonalController@actualizarpersonal')->name('actualizarpersonal')->middleware('auth');
Route::delete('/eliminarusuario/{id}', 'App\Http\Controllers\PersonalController@eliminarusuario')->name('eliminarusuario')->middleware('auth');

# Sala
Route::get('administrarsala/{id}', 'App\Http\Controllers\SalaController@administrarsala')->name('administrarsala')->middleware('auth');
Route::post('crearsala/{idSistema}', 'App\Http\Controllers\SalaController@crearsala')->name('crearsala')->middleware('auth');
Route::delete('/eliminarsala/{id}', 'App\Http\Controllers\SalaController@eliminarsala')->name('eliminarsala')->middleware('auth');
Route::get('/editarsala/{id}', 'App\Http\Controllers\SalaController@editarsala')->name('editarsala')->middleware('auth');
Route::put('/actualizarsala/{id}', 'App\Http\Controllers\SalaController@actualizarsala')->name('actualizarsala')->middleware('auth');

# Internacion
Route::get('paciente/internacion/{id}', 'App\Http\Controllers\InternacionController@cargarinternacion')->name('cargarinternacion')->middleware('auth');
Route::post('paciente/internacion2/{id}', 'App\Http\Controllers\InternacionController@cargarinternacion2')->name('cargarinternacion2')->middleware('auth');
Route::get('verinternacion/{id}', 'App\Http\Controllers\InternacionController@verinternacion')->name('verinternacion')->middleware('auth');

# Cama
Route::post('camasinfinitas', 'App\Http\Controllers\CamaController@camasinfinitas')->name('camasinfinitas')->middleware('auth');
Route::delete('/eliminarcama/{id}', 'App\Http\Controllers\CamaController@eliminarcama')->name('eliminarcama')->middleware('auth');

# Paciente
Route::get('cargarpaciente', 'App\Http\Controllers\PacienteController@cargarpaciente')->name('cargarpaciente')->middleware('auth');        #dni
Route::get('cargarpaciente2', 'App\Http\Controllers\PacienteController@cargarpaciente2')->name('cargarpaciente2')->middleware('auth');     #formulario completo
Route::get('cargarpaciente3', 'App\Http\Controllers\PacienteController@cargarpaciente3')->name('cargarpaciente3')->middleware('auth');     # validación
Route::get('pacientes', 'App\Http\Controllers\PacienteController@administrarpacientes')->name('administrarpacientes')->middleware('auth');
Route::delete('eliminarpaciente/{id}', 'App\Http\Controllers\PacienteController@eliminarpaciente')->name('eliminarpaciente')->middleware('auth');
Route::get('editarpaciente/{id}', 'App\Http\Controllers\PacienteController@editarpaciente')->name('editarpaciente');
Route::put('actualizarpaciente/{id}', 'App\Http\Controllers\PacienteController@actualizarpaciente')->name('actualizarpaciente')->middleware('auth');
Route::get('asignarmedico/{id}', 'App\Http\Controllers\PacienteController@asignarmedico')->name('asignarmedico');
Route::get('asignarmedico2/{idP}/{idM}', 'App\Http\Controllers\PacienteController@asignarmedico2')->name('asignarmedico2');
Route::get('desasignarmedico/{idP}/{idM}', 'App\Http\Controllers\PacienteController@desasignarmedico')->name('desasignarmedico');

# Evolucion
Route::get('cargar_evolucion/{id}', 'App\Http\Controllers\EvolucionController@cargar_evolucion')->name('cargar_evolucion')->middleware('auth');
Route::post('cargar_evolucion2', 'App\Http\Controllers\EvolucionController@cargar_evolucion2')->name('cargar_evolucion2')->middleware('auth');
Route::get('verevolucion/{id}', 'App\Http\Controllers\EvolucionController@ver_evolucion')->name('ver_evolucion')->middleware('auth');

# Reglas
Route::put('/actualizarreglas', 'App\Http\Controllers\ReglasController@actualizar_reglas')->name('actualizar_reglas')->middleware('auth');

# Alertas
Route::get('mostraralertas', 'App\Http\Controllers\AlertasController@mostrar_alertas')->name('mostrar_alertas')->middleware('auth');
Route::get('mostrarleidas', 'App\Http\Controllers\AlertasController@mostrar_leidas')->name('mostrar_leidas')->middleware('auth');
Route::get('markAsRead', 'App\Http\Controllers\AlertasController@markAsRead')->name('markAsRead')->middleware('auth'); # ruta donde marca a todas las noti leidas
Route::get('markOne/{id}', 'App\Http\Controllers\AlertasController@markOne')->name('markOne')->middleware('auth'); # ruta donde marca 1 notificacion