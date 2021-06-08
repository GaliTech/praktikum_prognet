@extends('template.admin_master')
@section('css')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection
@section('product-active')
active
@endsection

@section('content')
<h1 class="h3 text-dark">Daftar Produk</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="product/create" class="btn btn-info">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products_data as $product)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$product->product_name}}</td>
                        <td class="text-center">
                            <form action="/product/{{$product->id}}" method="POST" id="form_delete">
                                @csrf
                                {{ method_field('DELETE') }}
                                {{-- TOMBOL DETAIL --}}
                                <a href="/product/{{$product->id}}" class="btn btn-success">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                                {{-- TOMBOL DELETE --}}
                                <button type="submit" name="submit" class="btn btn-danger delete-confirm">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection

@section('javascript')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
@endsection
