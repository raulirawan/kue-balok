@extends('layouts.dashboard-admin')

@section('title','Halaman Detail Food')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Food</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Food</li>
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

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Detail Food</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <th style="width: 400px">Nama Makanan</th>
                            <td>{{ $food->name }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Harga</th>
                            <td>Rp. {{ number_format($food->price) }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Deskripsi</th>
                            <td>{{ $food->description }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Photo</th>
                            <td>
                                <img src="{{ Storage::url($food->photo) }}" style="max-width: 100px">
                            </td>
                        </tr>

                    </tbody>
                  </table>
                  <a href="{{ route('food.index') }}" class="btn btn-primary mt-3">Kembali</a>
                </div>

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
