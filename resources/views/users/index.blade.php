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
                            <h4>Data Users</h4>
                            @can('users-create')
                                <div class="card-header-action">
                                    <a href="{{ url('users/create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class=""">
                                <table class="table table-striped table-bordered nowwrap" style="width:100%" id="datatable-user">
                                    <thead>
                                        <tr>
                                            <th class="text-left" style="width: 15px">
                                                No.
                                            </th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Usuario</th>
                                            <th>Role</th>
                                            <th class="text-right" style="width: 75px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1
                                        @endphp

                                        @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $role)
                                                        <span class="badge badge-light">{{ $role }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @can('users-update')
                                                    <a href="{{ url('/users/' .$user->id. '/edit') }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                                @endcan
                                                @can('users-delete')
                                                <button class="btn btn-icon btn-danger delete-user" data-toggle="modal" data-target="#data-modal-delete" data-id="{{ $user->id }}"><i class="fas fa-times"></i></button>
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
                        <p>¿Está seguro de que desea eliminar estos datos?</p>
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
         $(document).ready(function(){
            $('#datatable-user').DataTable({
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

        $('#datatable-user').on('click', '.delete-user', function(){
            let id = $(this).data('id');

            $('.modal-title').html('Eliminar datos del Usuario.');
            $('.modal-content form').attr('action', '{{ url('/users/') }}/' +id);
        });
    </script>
@endsection
