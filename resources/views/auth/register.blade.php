@extends('layout')

@section('content')
<<<<<<< Updated upstream
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header text-white bg-primary">{{ __('Cargar personal') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                            <div class="col-md-6">
                                <select id="tipo" name="tipo" class="form-control">
                                    <option value="administrador" {{ old('tipo') == 'administrador' ? 'selected="selected"' : '' }}>Administrador</option>
                                    <option value="medico" {{ old('tipo') == 'medico' ? 'selected="selected"' : '' }}>Médico</option>
                                    <option value="jefe" {{ old('tipo') == 'jefe' ? 'selected="selected"' : '' }}>Jefe</option>
                                  </select>
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
                            <label for="legajo" class="col-md-4 col-form-label text-md-right">{{ __('Legajo') }}</label>

                            <div class="col-md-6">
                                <input id="legajo" type="text" maxlength="10" class="form-control @error('legajo') is-invalid @enderror" name="legajo" value="{{ old('legajo') }}" autocomplete="legajo" autofocus>

                                @error('legajo')
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
                            <label for="nombreUsuario" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="nombreUsuario" type="text" maxlength="15" class="form-control @error('nombreUsuario') is-invalid @enderror" name="nombreUsuario" value="{{ old('nombreUsuario') }}" required autocomplete="nombreUsuario">

                                @error('nombreUsuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" maxlength="15" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" maxlength="15" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
=======
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group row">
        <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

        <div class="col-md-6">
            <select id="tipo" name="tipo" class="form-control">
                <option value="medico" {{ old('tipo') == 'medico' ? 'selected="selected"' : '' }}>Médico</option>
                <option value="jefe" {{ old('tipo') == 'jefe' ? 'selected="selected"' : '' }}>Jefe</option>
                <option value="administrador" {{ old('tipo') == 'administrador' ? 'selected="selected"' : '' }}>Administrador</option>
                </select>
        </div>
    </div>
    <script src="{{ asset('cargarpersonal.js') }}"></script>

    <div id="sistema" class="form-group row">
        <label for="sistema" class="col-md-4 col-form-label text-md-right">{{ __('Sistema') }}</label>

        <div class="col-md-6">
            <select id="sistema" name="sistema" class="form-control">
                <option value="1" {{ old('sistema') == '1' ? 'selected="selected"' : '' }}>Guardia</option>
                <option value="2" {{ old('sistema') == '2' ? 'selected="selected"' : '' }}>Piso Covid</option>
                <option value="3" {{ old('sistema') == '3' ? 'selected="selected"' : '' }}>UTI</option>
                <option value="4" {{ old('sistema') == '4' ? 'selected="selected"' : '' }}>Hotel</option>
                <option value="5" {{ old('sistema') == '5' ? 'selected="selected"' : '' }}>Domicilio</option>
                </select>
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

    <div id="legajo" class="form-group row">
        <label for="legajo" class="col-md-4 col-form-label text-md-right">{{ __('Legajo') }}</label>

        <div class="col-md-6">
            <input id="legajo" type="text" maxlength="10" class="form-control @error('legajo') is-invalid @enderror" name="legajo" value="{{ old('legajo') }}" autocomplete="legajo" autofocus>

            @error('legajo')
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
        <label for="nombreUsuario" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

        <div class="col-md-6">
            <input id="nombreUsuario" type="text" maxlength="15" class="form-control @error('nombreUsuario') is-invalid @enderror" name="nombreUsuario" value="{{ old('nombreUsuario') }}" required autocomplete="nombreUsuario">

            @error('nombreUsuario')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" maxlength="15" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" maxlength="15" class="form-control" name="password_confirmation" required autocomplete="new-password">
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


>>>>>>> Stashed changes
@endsection
