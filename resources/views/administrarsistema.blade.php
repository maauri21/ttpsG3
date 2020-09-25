@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Administrar sistema') }}</div>
    
                    <div class="card-body">
                        <form method="GET" action="{{ route('administrarsala') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="sistema" class="col-md-4 col-form-label text-md-right">{{ __('Sistema') }}</label>
    
                                <div class="col-md-6">
                                    <select id="sistema" name="sistema" class="form-control">
                                        <option disabled selected value></option>
                                        <option value="1" {{ old('sistema') == 'guardia' ? 'selected="selected"' : '' }}>Guardia</option>
                                        <option value="2" {{ old('sistema') == 'pisocovid' ? 'selected="selected"' : '' }}>Piso Covid</option>
                                        <option value="3" {{ old('sistema') == 'uti' ? 'selected="selected"' : '' }}>Unidad Terapia Intensiva</option>
                                      </select>
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