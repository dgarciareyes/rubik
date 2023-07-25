@extends('layouts.error')

@section('pageTitle', '500')

@section('content')
    <div class="page-error">
        <div class="page-inner">
            <h1>500</h1>
            <div class="page-description">
                Hay una interrupción en<i>server</i>.
            </div>
            <div class="page-search">
                <div class="mt-3">
                    <a href="{{ url('/') }}">Volver al Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
