<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

//list model yang digunakan
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductCategoryDetails;
use App\Models\ProductImages;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        //menampilkan list produk
        $products_data = Product::with('RelasiProductCategories','RelasiProductImages')->get();
        return view ('admin.read_product_list',compact (['products_data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan halaman penambahan data produk
        $productCategories_data = ProductCategories::all();
        if ($productCategories_data->isEmpty()){
            return redirect('/product')->with('error','Tidak ada data kategori');
        }else{
            return view ('admin.create_product', compact(['productCategories_data']));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //untuk menyimpan data dari form
        //menyimpan data di tabel produk
        if(Product::where('product_name',$request->nama_produk)->exists()){
            return redirect('/product')->with('gagal','Produk sudah terdaftar!');
        }
        $products_data = new Product;
        $products_data->product_name = $request->nama_produk;
        $products_data->price = $request->harga_produk;
        $products_data->description = $request->deskripsi_produk;
        $products_data->stock = $request->stok_produk;
        $products_data->weight = $request->berat_produk;
        $products_data->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $products_data->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $products_data->save();

        //menyimpan nama file gambar dan menaruhnya di public
        if($request->hasFile('gambar_produk')){
            foreach ($request->file('gambar_produk') as $gambar){
                $productImage = new ProductImages;
                $productImage->product_id = $products_data->id; 
                $name= $gambar->getClientOriginalName();
                if (ProductImages::where('image_name',$name)->exists()){
                    $name = uniqid().'-'.$name;
                }
                $productImage->image_name = $name;
                $productImage->created_at = Carbon::now()->format('Y-m-d H:i:s');
                $productImage->updated_at = Carbon::now()->format('Y-m-d H:i:s'); 
                $gambar->move('image',$name);
                $productImage->save();
            }
        }

        //Menyimpan id dan kategori produk pada detail produk
        foreach ($request->kategori as $row){
            $productCategoryDetails = new ProductCategoryDetails;
            $productCategoryDetails->product_id = $products_data->id;
            $productCategoryDetails->category_id = $row;
            $productCategoryDetails->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $productCategoryDetails->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $productCategoryDetails->save();
        }
        return redirect('/product')->with('berhasil','Data produk berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //untuk menampilkan detail produk
        $products_data = Product::with('RelasiProductCategories','RelasiProductImages')->where('id',$id)->first(); 
        return view ('admin.detail_produk',compact (['products_data']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Menampilkan halaman edit
        $products_data=Product::where('id',$id)->first(); 
        $productCategory = ProductCategories::all();
        $productCategoryDetail = ProductCategoryDetails::where('product_id',$id)->pluck('category_id')->toArray();
        return view ('admin.edit_product',compact(['products_data','productCategory','productCategoryDetail']));
    }

    public function editGambar($id)
    {
        //Menampilkan tampilan edit gambar
        $images = ProductImages::where('product_id',$id)->get(); 
        return view ('admin.edit_gambar_produk',compact(['images', 'id']));
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
        //Memperbarui data
        Product::where('id',$id)->update([
            'product_name'=>$request->nama_produk,
            'price'=>$request->harga_produk,
            'description'=>$request->deskripsi_produk,
            'stock'=>$request->stok_produk,
            'weight'=>$request->berat_produk,
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
        ]);
        ProductCategoryDetails::where ('product_id', $id)->delete();
        foreach ($request->kategori as $row){
            $productCategoryDetail = new ProductCategoryDetails;
            $productCategoryDetail->product_id = $id;
            $productCategoryDetail->category_id = $row;
            $productCategoryDetail->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $productCategoryDetail->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $productCategoryDetail->save();
        }
        return redirect('/product')->with('berhasil','Data produk berhasil diupdate!');
    }

    public function updateGambar(Request $request,$id)
    {
        //Menampilkan tampilan edit gambar
        $name= $request->gambar_product->getClientOriginalName();
        if (ProductImages::where('image_name',$name)->exists()){
            $name = uniqid().'-'.$name;
        };
        $request->gambar_product->move('image',$name);
        ProductImages::where('id',$id)->update([
            'image_name'=>$name   
        ]);
        return redirect('/gambar/'.$request->product_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategoryDetails::where('product_id', $id)->delete();
        ProductImages::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect('/product')->with('berhasil','Data produk berhasil dihapus!');
    }

    public function hapusGambar(ProductImages $gambar)
    {
     \File::delete('image/'.$gambar->image_name);
      $gambar->delete();
      return redirect()->back();
   
        // return redirect('/product')->with('berhasil','Data produk berhasil dihapus!');
    }

    public function createGambar($id)
    {
        //menampilkan halaman penambahan data gambar produk
        $productimages = ProductImages::all();
        if ($productimages->isEmpty()){
            return redirect('/gambar')->with('error','Tidak ada data kategori');
        }else{
            return view ('admin.create_gambar_produk', compact(['productimages', 'id']));
        }
    }

    public function storeGambar($id, Request $request)
    {
        //menampilkan halaman penambahan data gambar produk
        $files = [];
        foreach ($request->file('gambar_produk') as $file) {
            if($file->isValid()){
                $nama_image = time()."_".$file->getClientOriginalName();
                $folder = 'image';
                $file->move($folder, $nama_image);
                $files[] = [
                    'product_id' => $id,
                    'image_name' => $nama_image,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ];
            }
        }

        ProductImages::insert($files);

        return redirect('/product');

    }
}
