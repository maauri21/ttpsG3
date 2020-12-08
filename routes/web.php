<?php

use Illuminate\Support\Facades\Route;

# Index
Route::get('/', 'App\Http\Controllers\HomeController@redir')->name('redir');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

# Sistema
Route::get('sistema/{id}', 'App\Http\Controllers\SistemaController@administrarsistema')->name('administrarsistema')->middleware('administrar_sistema');
Route::get('cambio_obito/{id}', 'App\Http\Controllers\SistemaController@cambio_obito')->name('cambio_obito')->middleware('permission:cambiar_sistema')->middleware('cambiar_sistema');
Route::get('cambio_egreso/{id}/{tipo}', 'App\Http\Controllers\SistemaController@cambio_egreso')->name('cambio_egreso')->middleware('permission:cambiar_sistema')->middleware('cambiar_sistema');
Route::get('cambio_uti/{id}', 'App\Http\Controllers\SistemaController@cambio_uti')->name('cambio_uti')->middleware('permission:cambiar_sistema')->middleware('cambiar_sistema');
Route::get('cambio_pc/{id}', 'App\Http\Controllers\SistemaController@cambio_pc')->name('cambio_pc')->middleware('permission:cambiar_sistema')->middleware('cambiar_sistema');
Route::get('cambio_hotel/{id}', 'App\Http\Controllers\SistemaController@cambio_hotel')->name('cambio_hotel')->middleware('permission:cambiar_sistema')->middleware('cambiar_sistema');
Route::get('cambio_domicilio/{id}', 'App\Http\Controllers\SistemaController@cambio_domicilio')->name('cambio_domicilio')->middleware('permission:cambiar_sistema')->middleware('cambiar_sistema');

# Personal
Route::get('personal', 'App\Http\Controllers\PersonalController@administrarpersonal')->name('administrarpersonal')->middleware('auth');
Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register')->middleware('permission:cargar_personal');
Route::get('/editarpersonal/{id}', 'App\Http\Controllers\PersonalController@editarpersonal')->name('editarpersonal')->middleware('permission:modificar_personal');
Route::put('/actualizarpersonal/{id}', 'App\Http\Controllers\PersonalController@actualizarpersonal')->name('actualizarpersonal')->middleware('permission:modificar_personal');
Route::delete('/eliminarusuario/{id}', 'App\Http\Controllers\PersonalController@eliminarusuario')->name('eliminarusuario')->middleware('permission:eliminar_personal');
Route::get('/cambiar_sistema/{id}', 'App\Http\Controllers\PersonalController@cambiar_sistema')->name('cambiar_sistema')->middleware('permission:cambiar_sistema_personal')->middleware('comprobar_sistema');
Route::put('/cambiar_sistema2/{id}', 'App\Http\Controllers\PersonalController@cambiar_sistema2')->name('cambiar_sistema2')->middleware('permission:cambiar_sistema_personal')->middleware('comprobar_sistema');
Route::get('/activar_alertas/{id}', 'App\Http\Controllers\PersonalController@activar_alertas')->name('activar_alertas')->middleware('auth');
Route::get('/desactivar_alertas/{id}', 'App\Http\Controllers\PersonalController@desactivar_alertas')->name('desactivar_alertas')->middleware('auth');

# Sala
Route::get('administrarsala/{id}', 'App\Http\Controllers\SalaController@administrarsala')->name('administrarsala')->middleware('auth');
Route::post('crearsala/{idSistema}', 'App\Http\Controllers\SalaController@crearsala')->name('crearsala')->middleware('permission:crear_salas');
Route::delete('/eliminarsala/{id}', 'App\Http\Controllers\SalaController@eliminarsala')->name('eliminarsala')->middleware('permission:eliminar_sala');
Route::get('/editarsala/{id}', 'App\Http\Controllers\SalaController@editarsala')->name('editarsala')->middleware('permission:modificar_sala');
Route::put('/actualizarsala/{id}', 'App\Http\Controllers\SalaController@actualizarsala')->name('actualizarsala')->middleware('permission:modificar_sala');

# Internacion
Route::get('paciente/internacion/{id}', 'App\Http\Controllers\InternacionController@cargarinternacion')->name('cargarinternacion')->middleware('permission:cargar_paciente')->middleware('mi_sistema:Guardia');
Route::post('paciente/internacion2/{id}', 'App\Http\Controllers\InternacionController@cargarinternacion2')->name('cargarinternacion2')->middleware('permission:cargar_paciente')->middleware('mi_sistema:Guardia');
Route::get('internaciones/{id}', 'App\Http\Controllers\InternacionController@internaciones')->name('internaciones')->middleware('auth');
Route::get('internacion_actual/{id}', 'App\Http\Controllers\InternacionController@internacion_actual')->name('internacion_actual')->middleware('permission:ver_paciente');
Route::get('internacion/{id}', 'App\Http\Controllers\InternacionController@internacion')->name('internacion')->middleware('auth');

# Cama
Route::post('camasinfinitas', 'App\Http\Controllers\CamaController@camasinfinitas')->name('camasinfinitas')->middleware('permission:camasInfinitas');
Route::delete('/eliminarcama/{id}', 'App\Http\Controllers\CamaController@eliminarcama')->name('eliminarcama')->middleware('permission:eliminar_cama');

# Paciente
Route::get('cargarpaciente', 'App\Http\Controllers\PacienteController@cargarpaciente')->name('cargarpaciente')->middleware('permission:cargar_paciente')->middleware('mi_sistema:Guardia');
Route::get('cargarpaciente2', 'App\Http\Controllers\PacienteController@cargarpaciente2')->name('cargarpaciente2')->middleware('permission:cargar_paciente')->middleware('mi_sistema:Guardia');
Route::get('cargarpaciente3', 'App\Http\Controllers\PacienteController@cargarpaciente3')->name('cargarpaciente3')->middleware('permission:cargar_paciente')->middleware('mi_sistema:Guardia');
Route::get('pacientes', 'App\Http\Controllers\PacienteController@administrarpacientes')->name('administrarpacientes')->middleware('auth');
Route::delete('eliminarpaciente/{id}', 'App\Http\Controllers\PacienteController@eliminarpaciente')->name('eliminarpaciente')->middleware('permission:eliminar_paciente');
Route::get('editarpaciente/{id}', 'App\Http\Controllers\PacienteController@editarpaciente')->name('editarpaciente')->middleware('permission:modificar_paciente');
Route::put('actualizarpaciente/{id}', 'App\Http\Controllers\PacienteController@actualizarpaciente')->name('actualizarpaciente')->middleware('permission:modificar_paciente');
Route::get('asignarmedico/{id}', 'App\Http\Controllers\PacienteController@asignarmedico')->name('asignarmedico')->middleware('permission:asignar_medico')->middleware('asignar_medico');
Route::get('asignarmedico2/{id}/{idM}', 'App\Http\Controllers\PacienteController@asignarmedico2')->name('asignarmedico2')->middleware('permission:asignar_medico')->middleware('asignar_medico');
Route::get('desasignarmedico/{idP}/{idM}', 'App\Http\Controllers\PacienteController@desasignarmedico')->name('desasignarmedico')->middleware('permission:desasignar_medico')->middleware('desasignar_medico');

# Evolucion
Route::get('cargar_evolucion/{id}', 'App\Http\Controllers\EvolucionController@cargar_evolucion')->name('cargar_evolucion')->middleware('permission:cargar_evolucion')->middleware('cargar_evolucion');
Route::post('cargar_evolucion2', 'App\Http\Controllers\EvolucionController@cargar_evolucion2')->name('cargar_evolucion2')->middleware('permission:cargar_evolucion');
Route::get('verevolucion/{id}', 'App\Http\Controllers\EvolucionController@ver_evolucion')->name('ver_evolucion')->middleware('auth');

# Reglas
Route::put('/actualizarreglas', 'App\Http\Controllers\ReglasController@actualizar_reglas')->name('actualizar_reglas')->middleware('permission:configurar_reglas');

# Alertas
Route::get('mostraralertas', 'App\Http\Controllers\AlertasController@mostrar_alertas')->name('mostrar_alertas')->middleware('permission:panel_alertas');
Route::get('mostrarleidas', 'App\Http\Controllers\AlertasController@mostrar_leidas')->name('mostrar_leidas')->middleware('permission:panel_alertas');
Route::get('markAsRead', 'App\Http\Controllers\AlertasController@markAsRead')->name('markAsRead')->middleware('permission:panel_alertas');
Route::get('markOne/{id}', 'App\Http\Controllers\AlertasController@markOne')->name('markOne')->middleware('permission:panel_alertas');