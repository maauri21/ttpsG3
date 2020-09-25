@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cargar paciente') }}</div>
    
                    <div class="card-body">
                        <form method="GET" action="{{ route('cargarpaciente3') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>
                                <div class="col-md-6">
                                    <input id="dni" type="text" maxlength="9" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $dni }}" required autocomplete="dni">
                                    @error('dni')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
    
                                <div class="col-md-6">
                                    <input id="nombre" type="text" maxlength="15" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
    
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
    
                                <div class="col-md-6">
                                    <input id="apellido" type="text" maxlength="20" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>
    
                                    @error('apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
    
                                <div class="col-md-6">
                                    <input id="direccion" type="text" maxlength="20" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="direcion" autofocus>
    
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
    
                                <div class="col-md-6">
                                    <input id="telefono" type="text" maxlength="15" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>
    
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fnac" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de nacimiento') }}</label>
    
                                <div class="col-md-6">
                                    <input id="fnac" type="date" class="form-control @error('fnac') is-invalid @enderror" name="fnac" value="{{ old('fnac') }}" required autocomplete="fnac" autofocus>
    
                                    @error('fnac')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mail') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" maxlength="30" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="obrasocial" class="col-md-4 col-form-label text-md-right">{{ __('Obra Social') }}</label>
    
                                <div class="col-md-6">
                                    <input id="obrasocial" type="text" maxlength="15" class="form-control @error('obrasocial') is-invalid @enderror" name="obrasocial" value="{{ old('obrasocial') }}" autocomplete="obrasocial" autofocus>
    
                                    @error('obrasocial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="antecedentes" class="col-md-4 col-form-label text-md-right">{{ __('Antecedentes personales') }}</label>
    
                                <div class="col-md-6">
                                    <input id="antecedentes" type="text" class="form-control @error('antecedentes') is-invalid @enderror" name="antecedentes" value="{{ old('antecedentes') }}" autocomplete="antecedentes" autofocus>
    
                                    @error('antecedentes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="border-top my-4"></div>
                            <h4 class="my-4" align=center>Contacto</h4>

                            <div class="form-group row">
                                <label for="nombreContacto" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
    
                                <div class="col-md-6">
                                    <input id="nombreContacto" type="text" maxlength="15" class="form-control @error('nombreContacto') is-invalid @enderror" name="nombreContacto" value="{{ old('nombreContacto') }}" autocomplete="nombreContacto" autofocus>
    
                                    @error('nombreContacto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="apellidoContacto" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="apellidoContacto" type="text" maxlength="20" class="form-control @error('apellidoContacto') is-invalid @enderror" name="apellidoContacto" value="{{ old('apellidoContacto') }}" autocomplete="apellidoContacto" autofocus>

                                @error('apellidoContacto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="relacion" class="col-md-4 col-form-label text-md-right">{{ __('Relación') }}</label>

                            <div class="col-md-6">
                                <input id="relacion" type="text" maxlength="15" class="form-control @error('relacion') is-invalid @enderror" name="relacion" value="{{ old('relacion') }}" autocomplete="relacion" autofocus>

                                @error('relacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefonoContacto" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="telefonoContacto" type="text" maxlength="15" class="form-control @error('telefonoContacto') is-invalid @enderror" name="telefonoContacto" value="{{ old('telefonoContacto') }}" autocomplete="telefonoContacto" autofocus>

                                @error('telefonoContacto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Aceptar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection