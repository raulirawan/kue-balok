@extends('layouts.dashboard-admin')

@section('title', 'Halaman Transaction')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transaction</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaction</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data User</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="">Date</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="date" value="{{ date('Y-m-d') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        <div class="">Kasir</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="text" value="{{ Str::ucfirst(Auth::user()->name) }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        <div class="">Customer</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <select name="" id="" class="form-control">
                                                <option value="Umum">Umum</option>
                                                <option value="Umum">Umum</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Food</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="">Food</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="hidden" name="food_id" id="food_id">
                                                <input type="hidden" name="price" id="price">
                                                <input type="text" class="form-control" name="name" id="name" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal"
                                                        data-target=".modal-item"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        <div class="">Qty</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="number" value="1" class="form-control" id="qty" name="qty"
                                                required min="1" max="100" oninput="validity.valid||(value='');">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" id="add_cart">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-4" id="sumtotal">
                        <div class="card">
                            <div class="card-header">
                                <h3>No Invoice</h3>
                                <h3 class="card-title text-bold" id="invoice">{{ $invoice }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12">
                                        <h1>Total</h1>
                                        <h1><b><span id="grand_total2" style="font-size:50pt;">0</span></b></h1>
                                        {{-- <input id="total" value="12000" name="total"> --}}
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
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
                                <h3 class="card-title">Data Transaction</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            {{-- <th style="width: 5%">No</th> --}}
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th style="width: 20%">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody id="cart_tabel">
                                        @include('admin.transaction.data-cart')
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Payment</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="">Subtotal</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="number" value="" id="sub_total" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="">Cash</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="number" id="cash" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        <div class="">Return</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="number" id="return" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Process Payment</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row ">
                                    <div class="col-4">
                                        <div class="">Status</div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="TAKE AWAY">TAKE AWAY</option>
                                                <option value="DINE IN">DINE IN</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block" id="create_transaction">Create
                                            Transaction</button>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button class="btn btn-danger btn-block" id="cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>



    <div class="modal fade modal-item" id="modal-item" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Foods</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th style="width: 20%">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($foods as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <button class="btn btn-xs btn-info" id="select"
                                                data-food_id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                data-price="{{ $item->price }}">
                                                <i class="fa fa-check"></i>
                                                Select
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('down-script')
    <script>
        $(document).ready(function() {
            calculate();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

            $(document).on('click', '#select', function() {
                var food_id = $(this).data('food_id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var qty = $(this).data('qty');
                $('#name').val(name);
                $('#price').val(price);
                $('#food_id').val(food_id);
                $('#qty').val(1);
                $('#modal-item').modal('hide');
            });

            // Untuk Add To Cart
            $(document).on('click', '#add_cart', function() {
                var food_id = $('#food_id').val();
                var priceFood = $('#price').val();
                var qty = $('#qty').val();
                var price = priceFood * qty;
                if (food_id == '') {
                    alert('Product belum dipilih');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('add.to.cart') }}",
                        data: {
                            'food_id': food_id,
                            'price': price,
                            'qty': qty
                        },
                        dataType: 'html',
                        success: function(result) {
                            if (result.success == undefined) {
                                $('#cart_tabel').load("{{ route('load.cart') }}",
                                    function() {
                                        calculate()
                                    });
                                $('#food_id').val('');
                                $('#price').val('');
                                $('#qty').val(1);
                            } else {
                                alert('Gagal tambah item cart');
                            }
                        },
                        error: function(request, status, error) {
                            var val = request.responseText;
                            alert("error" + val);
                        }
                    });


                }
            });

            $(document).on('click', '#delete_cart', function() {
                if (confirm('Yakin di Hapus ?')) {
                    var cart_id = $(this).data('cart_id');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('delete.cart') }}",
                        data: {
                            "_method": "DELETE",
                            'cart_id': cart_id,
                        },
                        dataType: 'html',
                        success: function(result) {
                            if (result.success == undefined) {
                                $('#cart_tabel').load("{{ route('load.cart') }}",
                                    function() {
                                        calculate()
                                    });

                            } else {
                                alert('Gagal tambah item cart');
                            }
                        },
                        error: function(request, status, error) {
                            var val = request.responseText;
                            alert("error" + val);
                        }
                    });
                }



            });

            $(document).on('click', '#cancel', function() {
                if (confirm('Yakin di Batalkan ?')) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('delete.all.cart') }}",
                        data: {
                            "_method": "DELETE",
                        },
                        dataType: 'html',
                        success: function(result) {
                            if (result.success == undefined) {
                                $('#cart_tabel').load("{{ route('load.cart') }}",
                                    function() {
                                        calculate()
                                    });

                            } else {
                                alert('Gagal Cancel Transaksi');
                            }
                        },
                        error: function(request, status, error) {
                            var val = request.responseText;
                            alert("error" + val);
                        }
                    });
                }



            });

            function calculate() {
                var subtotal = 0;
                $('#cart_tabel tr').each(function() {
                    subtotal += parseInt($(this).find('#total').text(), 10)
                })
                isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)


                var grand_total = subtotal;
                //console.log(subtotal);
                if (isNaN(grand_total)) {
                    $('#sub_total').val(0)
                    $('#grand_total2').text(0)
                } else {
                    $('#sub_total').val(grand_total)
                    $('#grand_total2').text(grand_total)
                }

                //hitung kembalian
                var cash = $('#cash').val();
                cash != 0 ? $('#return').val(cash - grand_total) : $('#return').val(0);
            }

            $(document).on('keyup mouseup', '#cash', function() {
                calculate()
            });

            $(document).on('click', '#create_transaction', function() {
                var invoice = $('#invoice').text();
                var grandTotal = $('#grand_total2').text();
                var total_price = $('#sub_total').val();
                var cash = $('#cash').val();
                var kembalian = $('#return').val();
                var status = $('#status').val();
                if (kembalian >= 0) {
                    if (confirm('Buat Transaksi ?')) {

                        $.ajax({
                            type: "POST",
                            url: "{{ route('transaction.create') }}",
                            data: {
                                'invoice': invoice,
                                'total_price': total_price,
                                'cash': cash,
                                'kembalian': kembalian,
                                'status': status,
                            },
                            dataType: "json",
                            success: function(result, textStatus, jqXHR) {
                                if (textStatus == 'success') {
                                    $('#cart_tabel').load("{{ route('load.cart') }}",
                                        function() {
                                            calculate();
                                            alert('berhasil');
                                            var total_price = $('#sub_total').val(0);
                                            var cash = $('#cash').val(0);
                                            var kembalian = $('#return').val(0);
                                        });
                                        window.open("{{ url('admin/print/bon') }}" + '/' + result.transaction_id,
                                                '_blank')
                                        location.reload();

                                } else {
                                    alert('Transaksi Gagal');
                                }

                            },
                            error: function(request, status, error) {
                                var val = request.responseText;
                                alert("error" + val);
                            }
                        });
                    }
                } else {
                    alert('Cash Tidak Boleh Kurang Dari Sub Total')
                }




            });

        });

        // fungsi rupiah
        // var rupiah = document.getElementById("rupiah");
        // rupiah.addEventListener("keyup", function(e) {
        //     // tambahkan 'Rp.' pada saat form di ketik
        //     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        //     rupiah.value = formatRupiah(this.value, "Rp. ");
        // });

        // /* Fungsi formatRupiah */
        // function formatRupiah(angka, prefix) {
        //     var number_string = angka.replace(/[^,\d]/g, "").toString(),
        //         split = number_string.split(","),
        //         sisa = split[0].length % 3,
        //         rupiah = split[0].substr(0, sisa),
        //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
        //     if (ribuan) {
        //         separator = sisa ? "." : "";
        //         rupiah += separator + ribuan.join(".");
        //     }

        //     rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        //     return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        // }
    </script>
@endpush
