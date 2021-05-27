@extends('template.admin_master')
@section('css')
<link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>
@endsection
@section('product-active')
active
@endsection
@section('content')
<h1 class="h3 text-dark">Input Data Diskon</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{Route('discount.store')}}" method="POST" enctype="multipart/form-data" name="discount" id="discount">
            @csrf
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Besar Diskon (%)</h6>
                </label>
                <div class="col-sm-10">
                    <input name="percentage" id="persentase_disc" type="number" class="form-control"
                        placeholder="Persentase Diskon">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Tanggal Mulai</h6>
                </label>
                <div class="col-sm-10">
                    <input name="start" id="tgl_mulai" type="date" class="form-control"
                        placeholder="(dd/mm/yyyy)">
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Tanggal Berakhir</h6>
                </label>
                <div class="col-sm-10">
                    <input name="end" id="tgl_berakhir" type="date" class="form-control"
                        placeholder="(dd/mm/yyyy)">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Produk</h6>
                </label>
                <div class="col-sm-10">
                    <div class="row">
                    <select name="id_product" id="">
                        @foreach ($products as $products_data)
                            <option value="{{$products_data->id}}">
                                {{$products_data->product_name}}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>

            <div class="float-right">
                <a href="/discount" class="btn btn-info ">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn btn-success"> <i class="fas fa-paper-plane"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
{{-- <script>
    $(document).ready(function(){
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
        });
    document.getElementById("product_data").onsubmit = function () {
        var error_produk = document.forms["product_data"]["nama_produk"].value;
        var error_harga = document.forms["product_data"]["harga_produk"].value;
        var error_deskripsi = document.forms["product_data"]["deskripsi_produk"].value;
        var error_stok = document.forms["product_data"]["stok_produk"].value;
        var error_berat = document.forms["product_data"]["berat_produk"].value;
        var error_gambar = document.forms["product_data"]["gambar_produk"].value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;


        var submit = true;

        if (error_produk == null || error_produk == "") {
            msg_error = "Silakan masukkan nama produk.";
            document.getElementById("nama_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("nama_produk_error").innerHTML = ""
        }

        if (error_harga == null || error_harga == "") {
            msg_error = "Silakan masukkan harga produk.";
            document.getElementById("harga_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("harga_produk_error").innerHTML = ""
        }

        if (error_deskripsi == null || error_deskripsi == "") {
            msg_error = "Silakan masukkan deskripsi produk.";
            document.getElementById("deskripsi_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("deskripsi_produk_error").innerHTML = ""
        }

        if (error_stok == null || error_stok == "") {
            msg_error = "Silakan masukkan jumlah stok produk.";
            document.getElementById("stok_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("stok_produk_error").innerHTML = ""
        }

        if (error_berat == null || error_berat == "") {
            msg_error = "Silakan masukkan berat produk.";
            document.getElementById("berat_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("berat_produk_error").innerHTML = ""
        }
        if(!allowedExtensions.exec(error_gambar)){
            msg_error = "Silakan masukkan gambar dengan format jpeg/.jpg/.png";
            document.getElementById("error_gambar_produk").innerHTML = msg_error;
            submit = false;
        }else {
            document.getElementById("error_gambar_produk").innerHTML = ""
        }
        return submit;
    }
    }); 
</script> --}}
@endsection