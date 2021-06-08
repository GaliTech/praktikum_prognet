<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductReviews;
use App\Models\Transactions;
use App\Models\Response;
use App\Models\Admin;
use App\Models\User;
use App\Models\AdminNotifications;
use App\Models\UserNotifications;
use Illuminate\Support\Facades\Auth;
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
        $product_reviews = ProductReviews::where('product_id', '=', $products_data->id)->with('user')->paginate(5);
        $user = Auth::user();
        $user_review = ProductReviews::where('product_id', '=', $products_data->id)->where('user_id', '=', $user->id)->with('user')->first();
        $transaction = Transactions::where('user_id', $user->id)->where('status', 'success')->get();
        return view('detailproduk_user',compact('products_data', 'product_reviews', 'user', 'user_review', 'transaction'));
        // 'product_reviews','user','user_review'
    }

    public function review_product($id, Request $request)
    {
        $request->validate([
            'rate' => ['required'],
            'content' => ['required', 'max:100']
        ]);

        $user = Auth::user();
        $review = new ProductReviews();
        $review->product_id = $id;
        $review->user_id = $user->id;
        $review->rate = $request->rate;
        $review->content = $request->content;
        if($review->save()){
            $product = Product::find($id);
            $avg_rate = DB::select('SELECT AVG(rate) as avg_rate FROM product_reviews WHERE product_id=?', [$id]);
            $avg_rate = json_decode(json_encode($avg_rate), true);
            $product->product_rate = (int)round($avg_rate[0]["avg_rate"]);
            $product->save();

            //Notif Admin
            $admin = Admin::find(1);
            $data = [
                'nama'=> $user->name,
                'message'=>'mereview product!',
                'id'=> $id,
                'category' => 'review'
            ];
            $data_encode = json_encode($data);
            $admin->createNotif($data_encode);

            //Notif User
            $data = [
                'nama'=> $user->name,
                'message'=>'Review dikirimkan!',
                'id'=> $id,
                'category' => 'review'
            ];
            $data_encode = json_encode($data);
            $user->createNotifUser($data_encode);

            return redirect()->back()->with("Success", "Successfully Comment");
        }
        return redirect()->back()->with("error", "Failed Comment");
    }

    public function notif($id) 
    {
        $notification = UserNotifications::find($id);
        $notif = json_decode($notification->data);
        $date = Carbon::now('Asia/Makassar');
        UserNotifications::where('id', $id)
                ->update([
                    'read_at' => $date
                ]);
        
        if ($notif->category == 'transaction') {
            return redirect()->route('myorder');
        } elseif ($notif->category == 'review') {
            return redirect()->route('detail_produk', $notif->id);
        }
    }
}
