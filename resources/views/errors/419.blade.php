@extends('layouts.error')

@section('pageTitle', '419')

@section('content')
    <div class="page-error">
        <div class="page-inner">
            <h1>419</h1>
            <div class="page-description">
                Lo sentimos, la página expiró.
            </div>
            <div class="page-search">
                <div class="mt-3">
                    <a href="{{ url('/') }}">Volver al Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
