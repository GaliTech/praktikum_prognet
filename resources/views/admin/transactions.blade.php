@extends('template.admin_master')
@section('css')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection
@section('product-active')
active
@endsection
@section('content')
<h1 class="h3 text-dark">Transaksi</h1>
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
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Total Harga</th>
                        <th class="text-center">Tanggal Pemesanan</th>
                        <th class="text-center">Bukti Pembayaran</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center"><a style="text-decoration: none; color: inherit;" href="{{ route('transactions.detail', ['id' => $transaction->id]) }}">{{$transaction->id}}</a></td>
                        <td>{{ "Rp" . number_format($transaction->total, 0, ",", ",") }}</td>
                        <td class="text-center">{{$transaction->created_at->format('d/m/Y H:m:s')}}</td>
                        <td class="text-center">
                            @if (isset($transaction->proof_of_payment))
                                <button class="btn btn-sm btn-info"><a style="text-decoration: none; color: inherit;" href="{{asset('payment/'.$transaction->proof_of_payment)}}" target="_blank">Lihat Bukti</a></button>                   
                            @else 
                                Tidak ada
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($transaction->status == 'unverified' && $transaction->proof_of_payment == NULL)
                                <span class="label label-default">Belum Bayar</span>
                            @elseif (($transaction->status == 'unverified') && (isset($transaction->proof_of_payment)))
                                <span class="label label-warning">Pending</span>
                            @elseif ($transaction->status == 'verified')
                                <span class="label label-info">Segera Dikirim</span>
                            @elseif ($transaction->status == 'delivered')
                                <span class="label label-primary">Dikirim</span>
                            @elseif ($transaction->status == 'success')
                                <span class="label label-success">Diterima</span>
                            @elseif ($transaction->status == 'expired')
                                <span class="label label-danger">Expired</span>
                            @elseif ($transaction->status == 'canceled')
                                <span class="label label-danger">Canceled</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- TOMBOL APPROVE --}}
                            @if (($transaction->status == 'unverified') && (isset($transaction->proof_of_payment)))
                                <form action="{{url('approve/'. $transaction->id)}}" method="POST" class="mb-2">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary"> 
                                        <i class="fas fa-edit"></i> Approve
                                    </button>
                                </form>
                            @endif
                            
                            {{-- TOMBOL KIRIM --}}
                            @if ($transaction->status == 'verified')
                                <form action="{{ url('delivered/'. $transaction->id) }}" method="POST" class="mb-2">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info"> 
                                        <i class="fas fa-edit"></i> Kirim
                                    </button>
                                </form>
                            @endif
                            
                            {{-- TOMBOL DELETE --}}
                            @if (($transaction->status == 'unverified' && $transaction->proof_of_payment == NULL) || (($transaction->status == 'unverified') && (isset($transaction->proof_of_payment))) || ($transaction->status == 'verified'))
                                <form action="{{ url('canceled/'. $transaction->id) }}" method="POST" class="mb-2">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}    
                                    <button type="submit" class="btn btn-danger delete-confirm"> 
                                        <i class="fas fa-trash-alt"></i> Cancel
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
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