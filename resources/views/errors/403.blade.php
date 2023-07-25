@extends('layouts.error')

@section('pageTitle', '403')

@section('content')
    <div class="page-error">
        <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">
                Lo siento, no tienes <i>permission</i> para acceder a esta página.
            </div>
            <div class="page-search">
                <div class="mt-3">
                    <a href="{{ url('/') }}">Volver al Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
