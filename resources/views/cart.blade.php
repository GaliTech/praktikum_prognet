@extends('template.user_master')
@section('content')
<div class="brand">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="titlepage">
                    <h2>Carts</h2>
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
                @if (count($cart) <= 0)
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="card shadow mb-4">
                                    <div class="card-body">
                                        Belum ada produk di keranjang!
                                    </div>
                            </div>
                        </div>
                    </div>
                @else
                    <form action="{{ route('cart.checkout') }}"  method="post">
                        @csrf
                        @method('POST')
                        @foreach ($cart as $item)
                        <div class="row">
                            <div class="col-1">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <input type="checkbox" name="cart_id[]" value="{{ $item->id }}">
                                    </div> 
                                </div>  
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <h1> {{$item->product->product_name}}</h1>
                                            <h2> Rp{{number_format($item->product->price)}}</h2>
                                            <p> <strong>Qty            :</strong> {{$item->qty}}</p>
                                            <a href="{{URL::to('cart/'.$item->id)}}" style="text-decoration: none; color: inherit;"><i class="fa fa-trash"></i> </a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12 col-lg-4">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-shopping-cart"></i> Checkout
                            </button>
                        </div>
                    </form>
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