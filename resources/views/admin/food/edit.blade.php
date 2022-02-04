@extends('layouts.dashboard-admin')

@section('title', 'Halaman Edit Food')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Food</h1>
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
                                <h3 class="card-title">Form Edit Data Food</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('food.update', $food->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Produk</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $food->name }}" name="name" placeholder="Nama Produk">
                                        <div class="invalid-feedback">
                                            Masukan Nama Produk
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            value="{{ $food->price }}" name="price" placeholder="Harga">
                                        <div class="invalid-feedback">
                                            Masukan Harga
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="{{ $food->kategori }}" selected>{{ $food->kategori }}
                                            </option>
                                            <option value="Makanan">Makanan</option>
                                            <option value="Minuman">Minuman</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Masukan Kategori
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deskripsi</label>
                                        <textarea name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Deskripsi">{{ $food->description }}</textarea>
                                        <div class="invalid-feedback">
                                            Masukan Deskripsi
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Foto</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            name="photo" placeholder="Foto Produk">
                                        <div class="invalid-feedback">
                                            Masukan Foto
                                        </div>
                                        <div class="mt-3">
                                            <img src="{{ url($food->photo) }}" style="max-width: 100px;">
                                        </div>
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
