@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('/companias') }}">Compañías</a></div>
                <div class="breadcrumb-item active">Agregar datos de Compañía</div>
            </div>
        </div>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('message') }}
                </div>
            </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Agregar datos de Compañía</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/companias') }}" enctype="multipart/form-data" class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label>Razón Social</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-building"></i>
                                            </div>
                                        </div>
                                        <input name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Ingrese el nombre..." value="{{ old('name') }}" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                            autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Rut</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-ticket-alt"></i>
                                            </div>
                                        </div>

                                        <input name="rut" type="text" maxlength="8" placeholder="Ingrese rut..."
                                            class="form-control col-3  @error('rut') is-invalid @enderror"
                                            value="{{ old('rut') }}" id="rut" onkeyup="rutdv(this.value);" onkeypress="return SoloNumeros(event)">
                                        @error('rut')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        &nbsp;_&nbsp;
                                        <input name="dv" type="text"
                                            class="form-control col-1  @error('dv') is-invalid @enderror"
                                            value="{{ old('dv') }}" id="dv" maxlength="1" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly="">
                                        @error('rut')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nemo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input name="nemo" type="text" placeholder="Ingrese su nemo..."
                                            class="form-control @error('nemo') is-invalid @enderror"
                                            value="{{ old('nemo') }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        @error('nemo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="card col-12">
                                                <label>Imagen</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                    </div>
                                                    <input name="image" type="file" id="image" accept="image/*"
                                                        class="form-control col-10 @error('image') is-invalid @enderror">
                                                    @error('image')
                                                        <div class="invalid-feedback col-5">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="card col-12">
                                                <img id="imagenSeleccionada" class=" col-10"
                                                    style="max-height:200px, max-width:100px">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary"><i
                                            class="fas fa-save"></i> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    <script>
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
