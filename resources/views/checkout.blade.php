@extends('template.user_master')
@section('content')
<div class="brand">
    <form action="{{ route('checkout.confirm') }}" method="post">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="brand-bg">
        <div class="container mb-4">
            @php $total = 0 @endphp
            @php $totalPotongan = 0 @endphp
            @php $weight = 0 @endphp
            @foreach ($cart['cart_id'] as $id)
                @php $item = \App\Models\Cart::with('product')->where('id', $id)->where('user_id', $user)->where('status', 'notyet')->get() @endphp
                @foreach ($item as $cart)
                    @php $subtotal = $cart->product->price * $cart->qty @endphp
                    @php $discount = DB::table('discounts')->where('id_product', '=', $cart->product_id)->whereDate('end', '>=', now())->get(); @endphp
                        @foreach ($discount as $disc)
                            @php $subDisc = ($disc->percentage*$cart->product->price)/100 @endphp
                            @php $totalPotongan += $subDisc @endphp
                        @endforeach
                    <div class="row">
                        <div class="col-1" hidden>
                            <div class="card shadow">
                                <div class="card-body">
                                    <input type="checkbox" checked name="product_id[]" value="{{ $cart->product_id }}" hidden>
                                </div> 
                            </div>       
                        </div>
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <h1> {{$cart->product->product_name}}</h1>
                                        <p> <strong>Price&nbsp;:&nbsp;&nbsp;Rp{{number_format($cart->product->price)}}</strong></p>
                                        <p> <strong>Qty&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp; {{$cart->qty}}</p>
                                        <p class="mb-3"> <strong>Weight&nbsp;:</strong> {{($cart->product->weight)/1000}}kg</p>
                                        <h2> Subtotal:&nbsp; Rp{{number_format($subtotal)}}</h2>
                                    </div>
                            </div>
                        </div>
                    </div>
                    @php $total += $subtotal @endphp
                    @php $weight += $cart->product->weight @endphp
                @endforeach
            @endforeach
        </div>
        <div class="container">
            <div class="mt-50">
                <div class="cart-title">
                    <h2>Isi Form Berikut!</h2>
                </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" name="alamat" placeholder="Alamat Lengkap" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select name="provinsi" id="provinsi" class="form-control p-1">
                                <option value="0">Pilih Provinsi Tujuan</option>
                                @foreach ($province as $provinsi => $value)
                                    <option value="{{ $provinsi }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select name="kota" id="kota" class="form-control p-1">
                                <option value="0">Pilih Kota/Kabupaten Tujuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select name="kurir" id="kurir" class="form-control p-1">
                                <option value="0">Pilih Kurir</option>
                                @foreach ($courier as $couriers => $value)
                                    <option value="{{ $couriers }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select name="payment" class="form-control p-1">
                                <option value="0">Pilih Metode Pembayaran</option>
                                <option value="bni">BNI Virtual Account</option>
                                <option value="bca">BCA Virtual Account</option>
                                <option value="bri">BRI Virtual Account</option>
                                <option value="mandiri">MANDIRI Virtual Account</option>
                           </select>
                        </div>
                    </div>
                    <div class="row" hidden>
                        <div class="col-sm-6 col-xs-12" hidden>
                             <div class="form-group">
                                  <input type="text" name="weight" hidden class="form-control" value="{{ $weight }}" placeholder="{{ $weight }}">
                                  <input type="text" name="discount" hidden class="form-control" value="{{ $totalPotongan }}" placeholder="{{ $totalPotongan }}">
                                  <input type="text" name="subtotal" hidden class="form-control" value="{{ $total-$totalPotongan }}" placeholder="{{ $total - $totalPotongan }}">
                             </div>
                        </div>
                   </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="cart-summary p-3">
                                    <h1><b><u>Checkout Total</u></b></h1>
                                    <ul class="summary-table">
                                        <li><span>Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>Rp{{number_format($total)}}</span></li>
                                        <li><span>Potongan&nbsp;&nbsp;&nbsp;&nbsp;:</span>&nbsp;&nbsp;&nbsp;<span>-Rp{{number_format($totalPotongan)}}</span></li>
                                    </ul>
                                    <h1 class="mt-2"><b>Total&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<span>Rp{{number_format($total - $totalPotongan)}}</b></h1>
                                    <div class="d-flex justify-content-center mt-2">
                                        <button type="submit" class="btn btn-danger">
                                         <i class="fas fa-shopping-cart"></i> Buat Pesanan & Cek Ongkir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>
     $(document).ready(function () {
          $('select[name="provinsi"]').on('change', function() {
               let provinceId = $(this).val();
               if (provinceId) {
                    jQuery.ajax({
                         url: '/provinsi/'+provinceId+'/kota',
                         type: 'GET',
                         dataType: 'json',
                         success:function(data) {
                              $('select[name="kota"]').empty();
                              $.each(data, function(key, value) {
                                   $('select[name="kota"]').append('<option value="'+key+'">'+value+'</option>');
                              });
                         },
                    });
               } else {
                    $('select[name="kota"]').empty();
                    $('select[name="Kota"]').append('<option value="0">Pilih Kota/Kabupaten Tujuan</option>');
               }
          });
     });
</script>