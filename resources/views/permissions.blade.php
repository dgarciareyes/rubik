@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
        </div>

        @if(session('message'))
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Permissions</h4>
                            @can('permissions-create')
                                <div class="card-header-action">
                                    <button class="btn btn-icon btn-primary create-permission" data-toggle="modal" data-target="#dataModal"><i class="fas fa-plus"></i></button>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowwrap" style="width:100%" id="datatable-permission">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 15px">
                                                No.
                                            </th>
                                            <th>Nombre</th>
                                            <th class="text-right" style="width: 75px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1
                                        @endphp

                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                @can('permissions-update')
                                                    <button class="btn btn-icon btn-warning edit-permission" data-toggle="modal" data-target="#dataModal" data-id="{{ $permission->id }}"><i class="far fa-edit"></i></button>
                                                @endcan
                                                @can('permissions-delete')
                                                    <button class="btn btn-icon btn-danger delete-permission" data-toggle="modal" data-target="#data-modal-delete" data-id="{{ $permission->id }}"><i class="fas fa-times"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="dataModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="#">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input id="nama" name="nama" type="text" class="form-control" onkeydown="return alphaOnly(event);" aria-describedby="nama-permission">
                            <small id="nama-permission" class="form-text text-muted">
                                Separar con un signo menos (-)
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="#">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>¿Está seguro de que desea eliminar estos datos??</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-danger btn-shadow">Si</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    <script>
        $('.create-permission').click(function(){
            $('.modal-title').html('Agregar Permisos');
            $('#edit').remove();
            $('.modal-content form').attr('action', '{{ url('/permissions/') }}');
            $('#nama').val('');
        });

        $('#datatable-permission').on('click', '.edit-permission',function(){
            let id = $(this).data('id');

            $('.modal-title').html('Editar Permisos');
            $('#edit').remove();
            $('.modal-content form').prepend('<input id="edit" type="hidden" name="_method" value="patch">');
            $('.modal-content form').attr('action', '{{ url('/permissions/') }}/' +id);

            $.ajax({
                type: 'get',
                url: '{{ url('/permissions/') }}/' +id,
                dataType: 'json',
                success: function(data) {
                    $('#nama').val(data.permission.name);
                }
            });
        });

        $('#datatable-permission').on('click', '.delete-permission', function(){
            let id = $(this).data('id');

            $('.modal-title').html('Eliminar Permisos');
            $('.modal-content form').attr('action', '{{ url('/permissions/') }}/' +id);
        });

        function alphaOnly(event) {
            let key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8 || key == 189);
        };

        $(document).ready(function(){
            $('#datatable-permission').DataTable({
                responsive:true,
                dom: 'Bfrtip',
                language: { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },

                buttons: [
                    {
                        extend:    'copyHtml5',
                        text:      '<i class="fa fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-secondary'
                    },
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-danger'
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-success'
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="fa fa-file-csv"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-warning'
                    },
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print"></i>',
                        titleAttr: 'Imprimir',
                        className: 'btn-info'
                    },

                ]
            })
        });
    </script>
@endsection
