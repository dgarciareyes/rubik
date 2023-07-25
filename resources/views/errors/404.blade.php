@extends('layouts.error')

@section('pageTitle', '404')

@section('content')
    <div class="page-error">
        <div class="page-inner">
            <h1>404</h1>
            <div class="page-description">
                Lo sentimos, esta página fue encontrada.
            </div>
            <div class="page-search">
                <div class="mt-3">
                    <a href="{{ url('/') }}">Volver al Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
