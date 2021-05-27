@extends('template.admin_master')
@section('css')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection
@section('product-active')
active
@endsection

@section('content')
<div class="row">
    @foreach ($images as $image)
    <div class="col-12 col-md-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <img src="../image/{{$image->image_name}}" class="mx-auto d-block" alt="logo" width="200px" height="200px"
                    onerror="this.onerror=null;this.src='../img/default.png'" />
                <br>
                <form action="/gambar/{{$image->id}}/destroy" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger delete-confirm"> <i class="fas fa-trash"></i>
                    Hapus</button>
            </form>
            </div>
            <div class="card-footer">
                <center>
                    <form action="/gambar/{{$image->id}}/update" method="POST" enctype="multipart/form-data"
                        name="data_gambar" id="data_gambar">
                        @csrf
                        {{ method_field('PUT') }}
                        <input name="product_id" type="hidden" value="{{$image->product_id}}">
                        <input name="gambar_product" id="gambar_product" type="file" class=""
                            accept="image/x-png,image/jpeg" required>
                        <button type="submit" class="btn btn-primary "> <i class="fas fa-pencil-alt"></i>
                            Ubah</button>
                    </form>
                </center>
            </div>
        </div>

    </div>
    @endforeach
</div>
{{-- TOMBOL BACK --}}
<a href="/product" class="btn btn-info">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
<a href="/gambar/{{$id}}/create" class="btn btn-success">
    <i class="fas fa-folder-plus"></i> Tambah Gambar
</a>
@endsection