@extends('template.admin_master')
@section('css')
@endsection
@section('product-active')
active
@endsection
@section('content')
<h1 class="h3 text-dark">Edit Data Produk</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/product/{{$products_data->id}}" method="POST" enctype="multipart/form-data" name="product_data" id="product_data">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Nama Produk</h6>
                </label>
                <div class="col-sm-10">
                    <input name="nama_produk" id="nama_produk" type="text" class="form-control"
                        placeholder="Nama Produk" value="{{$products_data->product_name}}">
                    <span class="error text-danger">
                        <h6 id="nama_produk_error"></h6>
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Harga Produk</h6>
                </label>
                <div class="col-sm-10">
                    <input name="harga_produk" id="harga_produk" type="number" class="form-control"
                        placeholder="Nominal Harga (berupa angka)" min="0" value="{{$products_data->price}}">
                    <span class="error text-danger">
                        <h6 id="harga_produk_error"></h6>
                    </span>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Deskripsi Produk</h6>
                </label>
                <div class="col-sm-10">
                    <textarea name="deskripsi_produk" id="deskripsi_produk" rows="3" placeholder="Deskripsi Produk"
                        class="form-control">{{$products_data->description}}</textarea>
                    <span class="error text-danger">
                        <h6 id="deskripsi_produk_error"></h6>
                    </span>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Stok</h6>
                </label>
                <div class="col-sm-10">
                    <input name="stok_produk" id="stok_produk" type="number" class="form-control"
                        placeholder="Jumlah Stok Produk (berupa angka)" value="{{$products_data->stock}}">
                    <span class="error text-danger">
                        <h6 id="stok_produk_error"></h6>
                    </span>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Berat Produk (g)</h6>
                </label>
                <div class="col-sm-10">
                    <input name="berat_produk" id="berat_produk" type="number" class="form-control"
                        placeholder="Berat Produk (dalam gram)" value="{{$products_data->weight}}">
                    <span class="error text-danger">
                        <h6 id="berat_produk_error"></h6>
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Kategori </h6>
                </label>
                <div class="col-sm-10">
                    <div class="row">
                        @foreach($productCategory as $kategori)
                        <div class="col-4">
                            <div class="form-check">
                                <input name="kategori[]" class="form-check-input" type="checkbox" id="gridCheck1"
                                    value="{{ $kategori->id }}" @if(in_array($kategori->id,
                                $productCategoryDetail))CHECKED @endif>
                                <label class="form-check-label" for="gridCheck1">
                                    {{ $kategori->category_name}}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="float-right">
                <a href="/product" class="btn btn-info ">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn btn-success "> <i class="fas fa-paper-plane"></i> Simpan</button>
            </div>
        </form>


    </div>

</div>

@endsection

@section('javascript')
<script>
    document.getElementById("product_data").onsubmit = function () {
        var error_produk = document.forms["product_data"]["nama_produk"].value;
        var error_harga = document.forms["product_data"]["harga_produk"].value;
        var error_deskripsi = document.forms["product_data"]["deskripsi_produk"].value;
        var error_kategori = document.forms["product_data"]["kategori_produk"].value;
        var error_stok = document.forms["product_data"]["stok_produk"].value;
        var error_berat = document.forms["product_data"]["berat_produk"].value;
        var error_gambar = document.forms["product_data"]["gambar_produk"].value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;


        var submit = true;

        if (error_produk == null || error_produk == "") {
            msg_error = "Silakan masukkan nama produk";
            document.getElementById("nama_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("nama_produk_error").innerHTML = ""
        }

        if (error_harga == null || error_harga == "") {
            msg_error = "Silakan masukkan harga produk";
            document.getElementById("harga_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("harga_produk_error").innerHTML = ""
        }

        if (error_deskripsi == null || error_deskripsi == "") {
            msg_error = "Silakan masukkan deskripsi produk";
            document.getElementById("deskripsi_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("deskripsi_produk_error").innerHTML = ""
        }

        if (error_kategori == 0) {
            msg_error = "Silakan pilih kategori produk";
            document.getElementById("kategori_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("kategori_produk_error").innerHTML = ""
        }

        if (error_stok == null || error_stok == "") {
            msg_error = "Silakan masukkan jumlah stok produk";
            document.getElementById("stock_produk_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("stock_produk_error").innerHTML = ""
        }

        if (error_berat == null || error_berat == "") {
            msg_error = "Silakan masukkan berat produk";
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

</script>
@endsection