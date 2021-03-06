@extends('layouts.dashboard-admin')

@section('title', 'Halaman Order online Detail')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order online Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Order online Detail</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Order online Detail</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <a href="{{ route('printBon', $transaction_id) }}" target="_blank" class="btn btn-primary mb-2">Cetak Bon</a>
                                <table id="table-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">Tanggal Transaksi</th>
                                            <th>Menu</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                        </tr>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">Jumlah</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    </thead>
                                    <tbody>
                                    </tbody>

                                </table>
                                {{-- {!! $dataTable->table() !!} --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('down-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endpush
@push('down-script')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{-- {!! $dataTable->scripts() !!} --}}

    <script>
        $(document).ready(function() {
            var datatable = $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                    type: 'GET',
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'potrait',
                        footer: true,
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true,
                    }
                ],

                columns: [{
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'food.name',
                        name: 'food.name'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                    },


                ],

                "footerCallback": function(row, data) {
                    var api = this.api(),
                        data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    total = api
                        .column(3)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    price = api
                        .column(3, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    $(api.column(3).footer()).html(
                        'Rp' + price
                    );

                    var numFormat = $.fn.dataTable.render.number('\,', 'Rp').display;
                    $(api.column(3).footer()).html(
                        'Rp ' + numFormat(price)
                    );

                    qty = api
                        .column(2, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    $(api.column(2).footer()).html(
                        qty
                    );
                }

            });



        });
    </script>
@endpush
