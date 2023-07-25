@extends('layouts.error')

@section('pageTitle', '429')

@section('content')
    <div class="page-error">
        <div class="page-inner">
            <h1>429</h1>
            <div class="page-description">
                Demasiados <i>requests</i>.
            </div>
            <div class="page-search">
                <div class="mt-3">
                    <a href="{{ url('/') }}">Volver al Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
