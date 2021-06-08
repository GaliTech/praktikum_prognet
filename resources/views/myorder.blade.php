@extends('template.user_master')
@section('content')
<div class="brand">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="titlepage">
                    <h2>My Order</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="brand-bg">
            <div class="container">
                @if (count($errors) > 0)
                    <div class="container alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                @if (count($transaction) <= 0)
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="card shadow mb-4">
                                    <div class="card-body">
                                        Belum ada barang yang Anda order!
                                    </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div id="carouselExampleControls" class="carousel slide" data-interval="false">
                        <div class="carousel-inner">
                            @foreach ($transaction as $order)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <div class="container">
                                        <div class="row justify-content-center align-self-center mb-5">
                                            <div class="well bg-white pt-4 pb-4 pl-5 pr-5 rounded col-xs-12 col-sm-12 col-md-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-5">
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                        <address>
                                                            <strong>Receipt: </strong>
                                                            <br>
                                                            {{ $order->user->name }}
                                                            <br>
                                                            {{ $order->address }}
                                                            <br>
                                                            {{ $order->regency .', '. $order->province }}
                                                        </address>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                                        <p>
                                                            <em>Tanggal : {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</em>
                                                        </p>
                                                        <p>
                                                            <em>Status : {{ ucfirst($order->status) }}</em>
                                                        </p>
                                                        <p>
                                                            <em>Kurir : {{ $order->courier->courier }}</em>
                                                        </p>
                                                        @if (($order->status == 'unverified') && (is_null($order->proof_of_payment)))
                                                            <p>
                                                                <em>Transfer ke : {{ substr(str_shuffle("0123456789"), 0, 16) }}</em>
                                                            </p>
                                                            <p>
                                                                <em>Batas Bayar : <em id="countdown{{$order->id}}"></em></em>
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
                                                            @php $transaction_detail = \App\Models\TransactionDetails::with('product')->where('transaction_id', $order->id)->get(); @endphp
                                                            @foreach ($transaction_detail as $order_detail)
                                                                <tr>
                                                                    <td class="col-md-9">
                                                                        <em>{{ $order_detail->product->product_name }}</em></h4>
                                                                        @if ($order->status == 'success')
                                                                            <button class="ml-2 btn btn-sm btn-info">
                                                                                <a style="text-decoration: none; color: inherit;" href="{{ url('detail_produk', ['id' => $order_detail->product_id]) }}" target="_blank">Review</a>
                                                                            </button>
                                                                        @endif
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
                                                                        <strong>{{ "Rp" . number_format($order->sub_total, 0, ",", ",") }}</strong>
                                                                    </p>
                                                                    <p>
                                                                        <strong>{{ "Rp" . number_format($order->shipping_cost, 0, ",", ",") }}</strong>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>   </td>
                                                                <td>   </td>
                                                                <td>   </td>
                                                                <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                                                <td class="text-center text-danger"><h4><strong>{{ "Rp" . number_format($order->total, 0, ",", ",") }}</strong></h4></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    @if ($order->status == 'unverified')
                                                        @if (is_null($order->proof_of_payment))
                                                            <form action="{{ route('order.payment') }}" method="POST" enctype="multipart/form-data" class="col-lg-12 mb-1">
                                                                {{ method_field('POST') }}
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <input type="text" hidden name="transaction_id" class="form-control" placeholder="{{ $order->id }}" value="{{ $order->id }}">
                                                                    <input type="file" name="payment" class="form-control {{ $errors->has('payment') ? ' is-invalid' : '' }}" >
                                                                    @if ($errors->has('payment'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('payment') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <button type="submit" class="btn btn-dark btn-lg btn-block">
                                                                    Upload Bukti Pembayaran   <span class="glyphicon glyphicon-chevron-right"></span>
                                                                </button>
                                                            </form>
                                                            <div class="container-fluid">
                                                                <form action="{{ url('cancel/'. $order->id) }}" method="POST">
                                                                    {{ method_field('PUT') }}
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-danger btn-lg btn-block mt-2">
                                                                        Batalkan Pesanan   <span class="glyphicon glyphicon-chevron-right"></span>
                                                                    </button>
                                                                </form>
                                                                <form id="timeout" action="{{ url('timeout/'. $order->id) }}" method="POST" hidden>
                                                                    {{ method_field('PUT') }}
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-danger btn-lg btn-block mt-2" hidden>
                                                                        Expired   <span class="glyphicon glyphicon-chevron-right" hidden></span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <script>
                                                                CountDownTimer('{{$order->created_at}}', 'countdown{{$order->id}}', '{{$order->timeout}}');
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
                                                    @elseif ($order->status == 'verified')
                                                        <button type="button" class="btn btn-info btn-lg btn-block">
                                                            Pesanan Sedang Dipersiapkan   <span class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                    @elseif ($order->status == 'delivered') 
                                                        <button type="button" class="btn btn-primary btn-lg btn-block">
                                                            Pesanan Sedang Dikirim   <span class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                        <form action="{{ url('success/'. $order->id) }}" method="POST" class="col-lg-12 mt-1">
                                                            {{  method_field('PUT') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                                                Sudah Terima Pesanan   <span class="glyphicon glyphicon-chevron-right"></span>
                                                            </button>
                                                        </form>
                                                    @elseif ($order->status == 'success')
                                                        <button type="button" class="btn btn-success btn-lg btn-block">
                                                            Pesanan Sudah Diterima   <span class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                    @elseif ($order->status == 'expired')
                                                        <button type="button" class="btn btn-light btn-lg btn-block">
                                                            Pesanan Expired   <span class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                    @elseif ($order->status == 'canceled')
                                                        <button type="button" class="btn btn-danger btn-lg btn-block">
                                                            Pesanan Dibatalkan   <span class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @endif
            </div>
    </div>
</div>
@endsection
{{-- @section('javascript')
    <script>
        	$(document).ready(function() {
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});
    </script>
@endsection --}}