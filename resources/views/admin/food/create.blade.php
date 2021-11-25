@extends('layouts.dashboard-admin')

@section('title', 'Halaman Tambah Food')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Food</h1>
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
                                <h3 class="card-title">Form Tambah Data Food</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('food.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Produk</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" name="name" placeholder="Nama Produk">
                                        <div class="invalid-feedback">
                                            Masukan Nama Produk
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price') }}" name="price" placeholder="Harga">
                                        <div class="invalid-feedback">
                                            Masukan Harga
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deskripsi</label>
                                        <textarea name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Deskripsi">{{ old('description') }}</textarea>
                                        <div class="invalid-feedback">
                                            Masukan Deskripsi
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Foto</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            value="{{ old('photo') }}" name="photo" placeholder="Foto Produk">
                                        <div class="invalid-feedback">
                                            Masukan Foto
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>

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
