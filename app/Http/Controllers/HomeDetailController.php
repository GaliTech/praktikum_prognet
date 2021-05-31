<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImages;
// use App\Models\ProductReview;
// use App\Models\Response;
// use App\Models\Admin;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products_data = Product::paginate(6);
        return view('home',compact('products_data'));
    }

    public function keranjang()
    {
        return view('welcome');
    }


    public function detail_product($id)
    {
        $products_data = Product::with('RelasiProductCategories','RelasiProductImages')->where('id',$id)->first(); 
        
        // $products_data = Product::find($id);
        // $product_images = ProductImages::where('product_id','=',$products_data->id)->get();
        // $product_reviews = ProductReview::where('product_id', '=', $product->id)->with('user')->paginate(5);
        // $user = Auth::user();
        // $user_review = Product_Review::where('product_id', '=', $product->id)->where('user_id', '=', $user->id)->with('user')->first();
        return view('detailproduk_user',compact('products_data'));
        // 'product_reviews','user','user_review'
    }

    // public function review_product($id, Request $request)
    // {
    //     $request->validate([
    //         'rate' => ['required'],
    //         'content' => ['required', 'max:100']
    //     ]);

    //     $user = Auth::user();
    //     $review = new Product_Review();
    //     $review->product_id = $id;
    //     $review->user_id = $user->id;
    //     $review->rate = $request->rate;
    //     $review->content = $request->content;
    //     if($review->save()){
    //         $product = Product::find($id);
    //         $avg_rate = DB::select('SELECT AVG(rate) as avg_rate FROM product_reviews WHERE product_id=?', [$id]);
    //         $avg_rate = json_decode(json_encode($avg_rate), true);
    //         $product->product_rate = (int)round($avg_rate[0]["avg_rate"]);
    //         $product->save();

    //         $admin = Admin::find(2);
    //         $details = [
    //             'order' => 'Review',
    //             'body' => 'User has review our Product!',
    //             'link' => url(route('product.edit',['id'=> $id])),
    //         ];

    //         return redirect()->back()->with("Success", "Successfully Comment");
    //     }
    //     return redirect()->back()->with("error", "Failed Comment");
    // }
}
