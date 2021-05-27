@extends('template.admin_master')
@section('css')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection
@section('product-active')
active
@endsection

@section('content')
<h1 class="h3 text-dark">Input Kurir Baru</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/courier" method="POST" enctype="multipart/form-data" name="data_kurir" id="data_kurir">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Nama Kurir</h6>
                </label>
                <div class="col-sm-10">
                    <input name="courier" id="courier" type="text" class="form-control"
                        placeholder="Contoh: JNE">
                    <span class="error text-danger">
                        <h6 id="courier_error"></h6>
                    </span>
                </div>
            </div>

            <div class="float-right">
                <a href="/courier" class="btn btn-info ">
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
    document.getElementById("data_kurir").onsubmit = function () {
        var error_courier = document.forms["data_kurir"]["courier"].value;
        var submit = true;
        if (errorCR == null || errorCR == "") {
            msg_error = "Silakan masukkan nama kurir.";
            document.getElementById("courier_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("courier_error").innerHTML = ""
        }
        return submit;
    }
</script>
@endsection