@extends('layouts.auth')

@section('pageTitle', 'Verifikasi Email')

@section('style')
    <!-- CSS Libraries -->
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header"><h4>Verifica tu correo electrónico</h4></div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        Se ha enviado un nuevo enlace para la verificación de correo electrónico a su correo electrónico.
                    </div>
                </div>
            @endif
            <p>
                Primero confirme el correo electrónico que le hemos enviado a su correo electrónico.<br><br>
                Si dentro de unos minutos no ha recibido el correo electrónico, verifique la carpeta de spam/bulk/junk en su correo electrónico.<br><br>
                O haga clic en el botón de abajo para hacer <i>request</i> Repetir.
            </p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Reenviar
                </button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endsection
