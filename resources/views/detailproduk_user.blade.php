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
                            <h3> {{$products_data->description}}</h3>
                            <br>
                            <h2> Rp{{number_format($products_data->price)}}</h2>
                            <p> <strong>Stok            :</strong> {{$products_data->stock}}</p>
                            <form action="{{route('cart.tambah')}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="number">
                                    {{-- <span button="minus" class="minus btn btn-light">-</span> --}}
                                    <input type="number" name="qty" min="1" {{--onkeydown="return false"--}}/>
                                    {{-- <span button="plus" class="plus btn btn-light">+</span> --}}
                                </div>
                                <br>
                                <button type="submit" class="btn btn-danger">
                                    <input type="text" name="product_id" value="{{ $products_data->id }}" hidden>
                                    <i class="fas fa-shopping-cart"></i> Beli Sekarang
                                </button>
                            </form>

                        </div>

                    </div>
                    <div class="card shadow mb-4 p-4">
                        <div class="container box_1170">
                            <div class="section-top-border">
                        <h3 class="">Review Customer</h3>
                        <hr class="mb-30" style="width:22%;text-align:left;margin-left:0">
                        <div class="row">
                          @foreach ($transaction as $order)
                            @php $transaction_detail = \App\Models\TransactionDetails::where('transaction_id', $order->id)->where('product_id', $products_data->id)->first(); @endphp
                            @if ($transaction_detail != null)
                              @if ($user_review==null)
                                <div class="col-lg-12 col-md-12">
                                  <form action="{{route('review',['id'=>$products_data->id])}}" method="POST">
                                    @csrf
                                    <input type="text" name="user_id" value="{{$user->id}}" hidden />
                                    <input type="text" name="product_id"  value="{{$products_data->id}}" hidden />
                                    <div class="input-group-icon mt-10">
                                      <div class="icon"><i class="fa fa-star" aria-hidden="true"></i></div>
                                      <div class="form-select" id="default-select">
                                      <select name="rate" class="form-control col-sm-2 p-0">
                                          <option disabled selected>Rating</option>
                                          <option value="1">★</option>
                                          <option value="2">★★</option>
                                          <option value="3">★★★</option>
                                          <option value="4">★★★★</option>
                                          <option value="5">★★★★★</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <input type="text" class="form-control col-lg-12" name="content" placeholder="Tulis review..."
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Content'" required
                                        class="single-input">
                                    </div>
                                    <div class="button-group-area mt-10">
                                      <input type="submit" class="btn genric-btn success radius" value="Submit" />
                                    </div>  
                                  </form>
                                </div>
                              @endif
                            @endif
                          @endforeach
                        </div>
                        @foreach ($product_reviews as $item)
                        <div class="row mt-3">
                                    <div class="d-inline-flex">
                                        <img src="{{asset('image_user/user.png')}}" style="height:50px;" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-md-9 mt-sm-20">
                            <p><b>{{$loop->iteration.'. '.$item->user->name}}</b></p>
                            <p>
                              @for ($i = 1; $i <= $item->rate; $i++)
                                  ★
                              @endfor
                            </p>
                            <p>{{$item->content}}</p>
                        </div>
                        </div>
                          @php
                              $responses = DB::table('response')->where('review_id','=',$item->id)->get();
                          @endphp
                          @if (!$responses->isEmpty())
                               @foreach ($responses as $respon)
                                  <div class="row mt-2 mb-3">
                                    <kbd>Response Admin</kbd>
                                    <div class="col">
                                      <small>{{$respon->content}}</small>
                                    </div>
                                  </div>
                                @endforeach
                          @endif
                        @endforeach
                        
                        
                            </div>
                            
                        </div>
                     </div>
                </div>
            </div>
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