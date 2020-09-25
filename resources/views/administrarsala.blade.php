@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Administrar sala') }}</div>

                    Lista de salas para este sistema, pudiendole agregar camas a ellas
                    <div class="border-top my-4"></div>
                    <h4 align=center>Nueva sala</h4>
                    <div class="card-body">
                        <form method="GET" action="{{ route('crearsala',$idSistema) }}">
                            @csrf
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
                                <label for="camas" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad de camas') }}</label>
    
                                <div class="col-md-6">
                                    <input id="camas" type="text" maxlength="4" class="form-control @error('camas') is-invalid @enderror" name="camas" value="{{ old('camas') }}" required autocomplete="camas" autofocus>
    
                                    @error('camas')
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