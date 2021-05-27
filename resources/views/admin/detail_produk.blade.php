@extends('template.admin_master')
@section('css')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection
@section('product-active')
active
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($products_data->RelasiProductImages as $gambar)
                        <div class="carousel-item {{$loop->iteration==1 ? 'active' : ''}}">
                            <img src="../image/{{$gambar->image_name}}" class=" mx-auto d-block" alt="logo" width="200px"/>
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev text-dark" href="#carouselExampleIndicators" role="button"
                        data-slide="prev">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next text-dark" href="#carouselExampleIndicators" role="button"
                        data-slide="next">
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="card-footer">
                <center><a href="/gambar/{{$products_data->id}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i>
                        Ubah Gambar</a></center>
            </div>
        </div>

    </div>
    <div class="col-12 col-md-8 col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <p> <strong>Nama Produk     :</strong> {{$products_data->product_name}}</p>
                <p> <strong>Harga Produk    :</strong> Rp{{number_format($products_data->price)}}</p>
                <p> <strong>Deskripsi       :</strong> {{$products_data->description}}</p>
                <p> <strong>Stok            :</strong> {{$products_data->stock}}</p>
                <p> <strong>Berat Produk(g) :</strong> {{$products_data->weight}}</p>
                <p> <strong>Kategori        :</strong>
                    @foreach ($products_data->RelasiProductCategories as $productCategories)
                    {{$productCategories->category_name}}, 
                    @endforeach
                </p>
                <div class="float-right">
                    <a href="/product" class="btn btn-info">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <a href="/product/{{$products_data->id}}/edit" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection