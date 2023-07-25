@extends('layouts.error')

@section('pageTitle', '401')

@section('content')
    <div class="page-error">
        <div class="page-inner">
            <h1>401</h1>
            <div class="page-description">
                <i>No Autorizado</i>.
            </div>
            <div class="page-search">
                <div class="mt-3">
                    <a href="{{ url('/') }}">Volver al Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
