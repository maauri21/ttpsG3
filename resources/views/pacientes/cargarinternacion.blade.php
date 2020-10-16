@extends('layout')

@section('nombrePanel')
Paciente
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')

<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">DNI</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{$paciente->dni}}>
    </div>
</div>
<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">Nombre</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{$paciente->nombre}}>
    </div>
</div>
<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">Apellido</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{$paciente->apellido}}>
    </div>
</div>
<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">Dirección</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{$paciente->direccion}}>
    </div>
</div>
<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">Teléfono</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{$paciente->telefono}}>
    </div>
</div>
<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">Fecha de nacimiento</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{ date("d/m/Y",strtotime($paciente->fnac)) }}>
    </div>
</div>   
<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">Email</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{$paciente->email}}>
    </div>
</div>   
<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">Obra Social</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{$paciente->obrasocial}}>
    </div>
</div>   
<div class="form-group row">
    <label for="camas" class="col-md-4 col-form-label text-md-right">Antecedentes personales</label>
    <div class="col-md-6">
        <input class="form-control" disabled value={{$paciente->antecedentes}}>
    </div>
</div>
@endsection

@section('content2')

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">Registrar internación</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('cargarinternacion2', $id) }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="fIniciosintomas" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de inicio de síntomas') }}</label>

                                    <div class="col-md-6">
                                        <input id="fIniciosintomas" type="date" class="form-control @error('fIniciosintomas') is-invalid @enderror" name="fIniciosintomas" value="{{ old('fIniciosintomas') }}" required autocomplete="fIniciosintomas">

                                        @error('fIniciosintomas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fDiagnosticocovid" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de diagnóstico COVID') }}</label>

                                    <div class="col-md-6">
                                        <input id="fDiagnosticocovid" type="date" class="form-control @error('fDiagnosticocovid') is-invalid @enderror" name="fDiagnosticocovid" value="{{ old('fDiagnosticocovid') }}" required autocomplete="fDiagnosticocovid">

                                        @error('fDiagnosticocovid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                                    <div class="col-md-6">
                                        <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion">

                                        @error('descripcion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Registrar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
