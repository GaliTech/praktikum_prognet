@extends('template.user_master')
@section('content')
<div class="brand">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Product Details</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="brand-bg">
        <div class="container">
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
                    </div>       
                </div>
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h1> {{$products_data->product_name}}</h1>
                            <h2> {{$products_data->description}}</h2>
                            <h3> Rp{{number_format($products_data->price)}}</h3>
                            <p> <strong>Stok            :</strong> {{$products_data->stock}}</p>
                            <form action="{{route('belanja')}}" method="GET">
                                @csrf
                                <div class="number">
                                    <span button="minus" class="minus btn btn-light">-</span>
                                    <input type="text" name="qty" value="1" onkeydown="return false"/>
                                    <span button="plus" class="plus btn btn-light">+</span>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-shopping-cart"></i> Beli Sekarang
                                </button>
                            </form>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
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
@endsection