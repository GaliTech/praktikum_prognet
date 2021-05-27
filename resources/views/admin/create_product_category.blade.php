@extends('template.admin_master')
@section('css')
@endsection
@section('product-active')
active
@endsection
@section('content')
<h1 class="h3 text-dark">Input Kategori Baru</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/product-category" method="POST" enctype="multipart/form-data" name="data_kategori" id="data_kategori">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Nama Kategori</h6>
                </label>
                <div class="col-sm-10">
                    <input name="nama_kategori" id="nama_kategori" type="text" class="form-control"
                        placeholder="Contoh: Handphone">
                    <span class="error text-danger">
                        <h6 id="nama_kategori_error"></h6>
                    </span>
                </div>
            </div>


            <div class="float-right">
                <a href="/product-category" class="btn btn-info">
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
    document.getElementById("data_kategori").onsubmit = function () {
        var error_category = document.forms["data_kategori"]["nama_kategori"].value;
        var submit = true;

        if (error_category == null || errorcategory == "") {
            msg_error = "Silakan masukkan nama kategori.";
            document.getElementById("nama_kategori_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("nama_kategori_error").innerHTML = ""
        }
        return submit;
    }

</script>

@endsection