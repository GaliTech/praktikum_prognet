<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

//list model yang digunakan
use App\Models\ProductCategories;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menampilkan daftar kategori produk
        $productCategories = ProductCategories::all();
        return view ('admin.read_product_category',compact (['productCategories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Menampilkan halaman untuk menambahkan data kategori produk
        return view ('admin.create_product_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //menyimpan data kategori
        if(ProductCategories::where('category_name',$request->nama_kategori)->exists()){
            return redirect('/product-category')->with('gagal','Data kategori sudah terdaftar!');
        }
        $productCategories = new ProductCategories;
        $productCategories->category_name = $request->nama_kategori;
        $productCategories->save();
        return redirect('/product-category')->with('berhasil','Data kategori berhasil ditambahkan!');
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
    public function edit($id)
    {
        //Menampilkan halaman edit kategori
        $productCategories=ProductCategories::where('id',$id)->first(); 
        return view ('admin.edit_product_category',compact(['productCategories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //memperbarui data
        ProductCategories::where('id',$id)->update([
            'category_name'=>$request->nama_kategori,
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
        ]);
        return redirect('/product-category')->with('berhasil','Data kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data kategori
        $productCategories=ProductCategories::find($id);
        $productCategories->delete();
        return redirect('/product-category')->with('berhasil','Data kategori berhasil dihapus!');
    }
}
