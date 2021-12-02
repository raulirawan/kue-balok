@extends('layouts.dashboard-admin')

@section('title', 'Halaman Data Pending')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Pending</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Pending</li>
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
                                <h3 class="card-title">Data Data Pending</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">Detail</th>
                                            <th style="width: 5%">Tanggal Transaksi</th>
                                            <th>Nama Customer</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th style="width: 20%">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($transactions as $item)
                                            <tr>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info"
                                                        style='float: left; margin-right: 5px'>Detail</a>

                                                </td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>Rp. {{ number_format($item->total_price) }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    @if ($item->status != 'CANCELLED')
                                                        <form action="{{ route('accept.order', $item->id) }}"
                                                            method="POST" style='float: left; padding-left: 5px;'>
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="btn btn-sm btn-success"
                                                                onclick="return confirm('Yakin ?')">Terima</button>

                                                        </form>
                                                        <form action="{{ route('reject.order', $item->id) }}"
                                                            method="POST" style='float: left; padding-left: 5px;'>
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ?')">Tolak</button>

                                                        </form>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
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

@push('down-script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
