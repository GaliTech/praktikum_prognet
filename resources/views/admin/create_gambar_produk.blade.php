@extends('template.admin_master')
@section('css')
@endsection
@section('product-active')
active
@endsection
@section('content')
<h1 class="h3 text-dark">Tambahkan Gambar Produk</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/gambar/{{$id}}/store" method="POST" enctype="multipart/form-data" name="" id="">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Gambar Produk</h6>
                </label>
                <div class="col-sm-10">
                    <input multiple name="gambar_produk[]" id="gambar_produk" type="file" class="" accept="image/*">
                </div>
            </div>


            <div class="float-right">
                <a href="/gambar" class="btn btn-info">
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
{{-- <script>
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

</script> --}}

@endsection