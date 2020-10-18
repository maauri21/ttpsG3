@extends('layout')

@section('nombrePanel')
Paciente
@endsection

@section('tamañoPanel')
col-md-12
@endsection

@section('content')
<div style="overflow-x:auto;">
    <table class="table table-hover" style="text-align: center">
        <thead>
            <tr>
                <th scope="col">DNI</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Direccion</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Fecha de nacimiento</th>
                <th scope="col">Email</th>
                <th scope="col">Obra Social</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{!empty($paciente->dni) ? $paciente->dni:''}}</td>
                <td>{{!empty($paciente->nombre) ? $paciente->nombre:''}}</td>
                <td>{{!empty($paciente->apellido) ? $paciente->apellido:''}}</td>
                <td>{{!empty($paciente->direccion) ? $paciente->direccion:''}}</td>
                <td>{{!empty($paciente->telefono) ? $paciente->telefono:''}}</td>
                <td>{{!empty($paciente->fnac) ? $paciente->fnac:''}}</td>
                <td>{{!empty($paciente->email) ? $paciente->email:''}}</td>
                <td>{{!empty($paciente->obrasocial) ? $paciente->obrasocial:''}}</td>
            </tr>
        </tbody>
    </table>
</div>
<div style="overflow-x:auto;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Antecedentes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{!empty($paciente->antecedentes) ? $paciente->antecedentes:''}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection