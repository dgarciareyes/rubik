@extends('layouts.auth')

@section('pageTitle', 'Ingresar')

@section('content')
    <div class="card card-primary">
        <div class="card-header"><h4>Ingresar</h4></div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    <div class="invalid-feedback">
                        ¡Introduzca su nombre de usuario!
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Contraseña</label>
                        @if (Route::has('password.request'))
                            <div class="float-right">
                                <a href="{{ route('password.request') }}" class="text-small">
                                    ¿Has olvidado tu contraseña?
                                </a>
                            </div>
                        @endif
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required autocomplete="current-password">
                    <div class="invalid-feedback">
                        ¡Introducir la contraseña!
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Recuérdame</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Ingresar
                    </button>
                </div>
                @if($errors->any())
                    <div class="text-center p-t-12 text-danger">
                        <span class="txt2">
                            <p>¡El nombre de usuario o la contraseña son incorrectos!</p>
                        </span>
                    </div>
                @endif
            </form>
        </div>
    </div>
    @if (Route::has('register'))
        <div class="mt-5 text-muted text-center">
            ¿Aún no tienes una cuenta? <a href="{{ route('register') }}">¡Regístrate aquí!</a>
        </div>
    @endif
@endsection

@section('script')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endsection
