@extends('template.admin_master')
@section('css')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection
@section('product-active')
active
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-8 col-lg-8">
        <div class="container">
            <div class="row justify-content-center align-self-center mb-5">
                <div class="well bg-white pt-4 pb-4 pl-5 pr-5 rounded col-xs-12 col-sm-12 col-md-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-5">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <address>
                                <strong>Receipt: </strong>
                                <br>
                                {{ $transactions->user->name }}
                                <br>
                                {{ $transactions->address }}
                                <br>
                                {{ $transactions->regency .', '. $transactions->province }}
                            </address>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <p>
                                <em>Tanggal : {{ \Carbon\Carbon::parse($transactions->created_at)->format('d/m/Y') }}</em>
                            </p>
                            <p>
                                <em>Status : {{ ucfirst($transactions->status) }}</em>
                            </p>
                            <p>
                                <em>Kurir : {{ $transactions->courier->courier }}</em>
                            </p>
                            @if (($transactions->status == 'unverified') && (is_null($transactions->proof_of_payment)))
                                <p>
                                    <em>Transfer ke : {{ substr(str_shuffle("0123456789"), 0, 16) }}</em>
                                </p>
                                <p>
                                    <em>Batas Bayar : <em id="countdown{{$transactions->id}}"></em></em>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-left">Product</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $transaction_detail = \App\Models\TransactionDetails::with('product')->where('transaction_id', $transactions->id)->get(); @endphp
                                @foreach ($transaction_detail as $order_detail)
                                    <tr>
                                        <td class="col-md-9">
                                            <em>{{ $order_detail->product->product_name }}</em></h4>
                                        </td>
                                        <td class="col-md-1 text-center">{{ $order_detail->qty }}</td>
                                        <td class="col-md-1 text-center">{{ "Rp" . number_format($order_detail->selling_price, 0, ",", ",") }}</td>
                                        <td class="col-md-1 text-center">{{ $order_detail->discount }}%</td>
                                        <td class="col-md-1 text-center">{{ "Rp" . number_format(($order_detail->selling_price - ($order_detail->selling_price * $order_detail->discount)/100)*$order_detail->qty, 0, ",", ",") }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td class="text-left">
                                        <p>
                                            <strong>Subtotal: </strong>
                                        </p>
                                        <p>
                                            <strong>Ongkir: </strong>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p>
                                            <strong>{{ "Rp" . number_format($transactions->sub_total, 0, ",", ",") }}</strong>
                                        </p>
                                        <p>
                                            <strong>{{ "Rp" . number_format($transactions->shipping_cost, 0, ",", ",") }}</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                    <td class="text-center text-danger"><h4><strong>{{ "Rp" . number_format($transactions->total, 0, ",", ",") }}</strong></h4></td>
                                </tr>
                            </tbody>
                        </table>
                        @if ($transactions->status == 'unverified')
                            @if (is_null($transactions->proof_of_payment))
                                    <button type="button" class="btn btn-dark btn-lg btn-block">
                                        Belum Upload Bukti Pembayaran   <span class="glyphicon glyphicon-chevron-right"></span>
                                    </button>
                                <div class="container-fluid">
                                    <form id="timeout" action="{{ url('timeout/'. $transactions->id) }}" method="POST" hidden>
                                        <button type="submit" class="btn btn-danger btn-lg btn-block mt-2" hidden>
                                            Expired   <span class="glyphicon glyphicon-chevron-right" hidden></span>
                                        </button>
                                    </form>
                                </div>
                                <script>
                                    CountDownTimer('{{$transactions->created_at}}', 'countdown{{$transactions->id}}', '{{$transactions->timeout}}');
                                    function CountDownTimer(dt, id, timeout)
                                    {
                                        var end = new Date(timeout);
                                        var _second = 1000;
                                        var _minute = _second * 60;
                                        var _hour = _minute * 60;
                                        var _day = _hour * 24;
                                        var timer;
                                        function showRemaining() {
                                            var now = new Date();
                                            var distance = end - now;
                                            if (distance < 0) {
                                                clearInterval(timer);
                                                document.getElementById(id).innerHTML = 'Expired'
                                                document.getElementById("timeout").submit();
                                                return;
                                            }
                                            var days = Math.floor(distance / _day);
                                            var hours = Math.floor((distance % _day) / _hour);
                                            var minutes = Math.floor((distance % _hour) / _minute);
                                            var seconds = Math.floor((distance % _minute) / _second);
                                
                                            document.getElementById(id).innerHTML = days + ' days ';
                                            document.getElementById(id).innerHTML += hours + ' hrs ';
                                            document.getElementById(id).innerHTML += minutes + ' mins ';
                                            document.getElementById(id).innerHTML += seconds + ' secs';
                                        }
                                        timer = setInterval(showRemaining, 1000);
                                    }
                                </script>
                            @else
                                <button type="button" class="btn btn-warning btn-lg btn-block">
                                    Sedang Menunggu Approval   <span class="glyphicon glyphicon-chevron-right"></span>
                                </button>
                            @endif
                        @elseif ($transactions->status == 'verified')
                            <button type="button" class="btn btn-info btn-lg btn-block">
                                Pesanan Sedang Dipersiapkan   <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        @elseif ($transactions->status == 'delivered') 
                            <button type="button" class="btn btn-primary btn-lg btn-block">
                                Pesanan Sedang Dikirim   <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        @elseif ($transactions->status == 'success')
                            <button type="button" class="btn btn-success btn-lg btn-block">
                                Pesanan Sudah Diterima   <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        @elseif ($transactions->status == 'expired')
                            <button type="button" class="btn btn-light btn-lg btn-block">
                                Pesanan Expired   <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        @elseif ($transactions->status == 'canceled')
                            <button type="button" class="btn btn-danger btn-lg btn-block">
                                Pesanan Dibatalkan   <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- TOMBOL APPROVE --}}
    @if (($transactions->status == 'unverified') && (isset($transactions->proof_of_payment)))
        <form action="{{url('approve/'. $transactions->id)}}" method="POST" class="mb-2">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary"> 
                <i class="fas fa-edit"></i> Approve
            </button>
        </form>
    @endif

    {{-- TOMBOL KIRIM --}}
    @if ($transactions->status == 'verified')
        <form action="{{ url('delivered/'. $transactions->id) }}" method="POST" class="mb-2">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-info"> 
                <i class="fas fa-edit"></i> Kirim
            </button>
        </form>
    @endif

    {{-- TOMBOL DELETE --}}
    @if (($transactions->status == 'unverified' && $transactions->proof_of_payment == NULL) || (($transactions->status == 'unverified') && (isset($transactions->proof_of_payment))) || ($transactions->status == 'verified'))
        <form action="{{ url('canceled/'. $transactions->id) }}" method="POST" class="mb-2">
            {{ method_field('PUT') }}
            {{ csrf_field() }}    
            <button type="submit" class="btn btn-danger delete-confirm"> 
                <i class="fas fa-trash-alt"></i> Cancel
            </button>
        </form>
    @endif
</div>
@endsection