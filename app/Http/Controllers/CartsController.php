<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Courier;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
    */

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $user = Auth::id();
        $cart = Cart::with('product')->where('user_id', $user)->where('status', 'notyet')->get();
        return view('cart', compact('cart'));
    } 

    /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
    */

    public function create()
    {
        //
    }

    /**
        * Store a newly created resource in storage.
        *
        * @param \Illuminate\Http\Request $request
        * @return \Illuminate\Http\Response
    */
    
    public function store(Request $request)
    {
        $user = Auth::id();
        $cek = Cart::where('user_id', '=', $user)
                    ->where('product_id', '=', $request->product_id)
                    ->where('carts.status', '=', 'notyet')->first();
        $product = Product::where('id', '=', $request->product_id)->first();
        
        if (is_null($cek)) {
            DB::table('carts')->insert(
                ['user_id' => $user,
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'status' => 'notyet']
            );

            DB::table('products')
            ->where('id', $request->product_id)
            ->update([
                'stock' => $product->stock - $request->qty
            ]);
            return redirect('/cart');
        }else{
            DB::table('carts')
            ->where('product_id', $request->product_id)
            ->update([
                'qty' => $cek->qty + $request->qty     
            ]);
            return redirect('/cart');
        } 
    }

    public function checkout(Request $request)
    {
        $messages = [
            'required' => 'Anda belum memilih product!',
        ];

        $user = Auth::id();
        $request->validate([
            'cart_id' => 'required'
        ], $messages);

        $checkout = session('checkout');
        $checkout = [
            'cart_id' => $request->cart_id
        ];
        session(['checkout' => $checkout]);
        return redirect('/checkout');
    }
    
    /**
        * Display the specified resource.
        *
        * @param \App\Cart $cart
        * @return \Illuminate\Http\Response
    */
    
    public function show(Cart $cart)
    {
        //
    }
    
    /**
        * Show the form for editing the specified resource.
        *
        * @param \App\Cart $cart
        * @return \Illuminate\Http\Response
    */

    public function edit(Cart $cart)
    {
        //
    }

    /**
        * Update the specified resource in storage.
        *
        * @param \Illuminate\Http\Request $request
        * @param \App\Cart $cart
        * @return \Illuminate\Http\Response
    */

    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param \App\Cart $cart
        * @return \Illuminate\Http\Response
    */

    public function destroy($id)
    {
        $cart = Cart::where('id', '=', $id)->delete();
        return redirect('/cart')->with('status', 'Product berhasil dihapus!');
    }

    public function transaction(Request $request)
    {
        //   
    }
}
