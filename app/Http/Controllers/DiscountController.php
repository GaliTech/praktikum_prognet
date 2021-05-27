<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

//list model yang digunakan
use App\Models\Discount;
use App\Models\Product;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menampilkan daftar diskon
        $discount = Discount::all();
        return view ('admin.read_discount_list',compact (['discount']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        //Menampilkan halaman untuk menambahkan data diskon
        return view ('admin.create_discount', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        if ( $request->start < date("Y-m-d") || $request->end < $request->start ) {
            return redirect()->back()->with('error','Tanggal start tidak boleh kurang dari hari ini atau tanggal end tidak boleh kurang dari tanggal start!');
        }else{
                $discounts = $request->all();
                Discount::create($discounts);
                return redirect('discount');
            
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //menampilkan halaman edit
        $products = Product::all();
        return view ('admin.edit_discount', compact('products', 'discount'));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //memperbarui data
        $discounts = $request->all();
        // dd($discounts);
        $discount->update($discounts);
        return redirect('discount');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //menghapus data diskon
        $discount->delete();
        return redirect('discount');
    }
}
