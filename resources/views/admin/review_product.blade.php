@extends('template.admin_master')
@section('css')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection
@section('product-active')
active
@endsection
@section('content')
<h1 class="h3 text-dark">Review Produk</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        {{-- <a href="/product-category/create" class="btn btn-info">
            <i class="fas fa-plus"></i> Tambah Kategori --}}
        </a>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Nama User</th>
                        <th class="text-center">Review</th>
                        <th class="text-center">Rating</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productReview as $product_review)
                    @php $response = \App\Models\Response::where('review_id', $product_review->id)->first() @endphp
                    <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center">{{$product_review->product->product_name}}</td>
                    <td class="text-center">{{$product_review->user->name}}</td>
                    <td class="text-center">{{$product_review->content}}</td>
                    <td class="text-center">
                        @for ($i = 1; $i <= $product_review->rate; $i++)
                            ★
                        @endfor
                    </td>
                    <td class="text-center">
                        @if ($response == NULL)
                            <input type="text" id="modal_id" value="{{$product_review->id}}" hidden>
                            {{--TOMBOL ADD--}}
                            <button type="button" id="add_response" class="btn btn-success" data-toggle="modal" data-target="#tambahresponse{{$product_review->id}}">
                                <i class="fas fa-edit"></i> Add Response
                            </button>
                        @else
                            <input type="text" id="modal_id" value="{{$product_review->id}}" hidden>
                            {{--TOMBOL EDIT--}}
                            <button type="button" id="edit_response" class="btn btn-primary mb-2" data-toggle="modal" data-target="#editresponse{{$product_review->id}}">
                                <i class="fas fa-edit"></i> Edit Response
                            </button>
                            {{-- TOMBOL DELETE --}}
                            <form action="{{route('delete.response', $response->id)}}" method="post">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" name="submit" class="btn btn-danger delete-confirm"> 
                                    <i class="fas fa-trash-alt"></i> Hapus Response
                                </button>
                            </form>
                        @endif
                    </td>
                    </tr>

                    @if ($response == NULL)
                        <!--------------------------------------- Modal Tambah Response--------------------------------------------- -->
                        <div class="modal fade" id="tambahresponse{{$product_review->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Menambahkan Response</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('admin.response')}}" method="POST" enctype="multipart/form-data">
                                        {{ method_field('POST') }}
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            {{-- ID Review --}}
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Review</label>
                                                <div class="col-sm-10">
                                                    <input name="review_id" readonly type="text" id="review_id" class="form-control"
                                                        value="{{ $product_review->id }}" placeholder="Review ID" hidden>
                                                    <input name="review" readonly type="text" id="reviewer" class="form-control"
                                                        value="{{ $product_review->user->name }}" placeholder="Reviewer">
                                                    <input name="review_content" readonly type="text" id="review_content" class="form-control"
                                                        value="{{ $product_review->content }}" placeholder="Review Content">
                                                </div>
                                            </div>
                                            {{-- Admin --}}
                                            <div class="form-group row" hidden>
                                            <label class="col-sm-5 col-form-label" hidden>Admin</label>
                                            <div class="col-sm-10">
                                                <input name="admin_id" readonly type="text" class="form-control"
                                                    value="{{Auth::user()->id}}" placeholder="{{Auth::user()->id}}" hidden>
                                            </div>
                                            </div>
                                            {{-- Response --}}
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Response</label>
                                                <div class="col-sm-10">
                                                    <input name="response" type="text" class="form-control"
                                                        placeholder="Tambahkan response Anda!">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!--------------------------------------- Modal Edit Response--------------------------------------------- -->
                        <div class="modal fade" id="editresponse{{$product_review->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sunting Response</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('edit.response', $response->id)}}" method="POST" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            {{-- Review --}}
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Review</label>
                                                <div class="col-sm-10">
                                                    <input name="review" readonly type="text" id="reviewer" class="form-control"
                                                        value="{{ $product_review->user->name }}" placeholder="Reviewer">
                                                    <input name="review_content" readonly type="text" id="review_content" class="form-control"
                                                        value="{{ $product_review->content }}" placeholder="Review Content">
                                                </div>
                                            </div>
                                            {{-- Admin --}}
                                            <div class="form-group row" hidden>
                                            <label class="col-sm-5 col-form-label" hidden>Admin</label>
                                            <div class="col-sm-10">
                                                <input name="admin_id" readonly type="text" class="form-control"
                                                    value="{{Auth::user()->id}}" placeholder="{{Auth::user()->id}}" hidden>
                                            </div>
                                            </div>
                                            {{-- Response --}}
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Response</label>
                                                <div class="col-sm-10">
                                                    <input name="response_id" id="response_id" type="text" class="form-control"
                                                        value="{{ $response->id }}" placeholder="Id Response" hidden>
                                                    <input name="response_edit" id="response_edit" type="text" class="form-control"
                                                        value="{{$response->content}}" placeholder="Edit Response Anda!">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @empty
                    <tr>
                        <td colspan="6">Tidak ada data</td>
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