<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\Transactions;
use App\Models\TransactionDetails;
use App\Models\Product;
use App\Models\Courier;
use App\Models\Product_Image; 
use App\Models\Product_Review; 
use App\Models\Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\Discount;
use App\Models\Admin;
use App\Models\Response;
use App\Models\AdminNotifications;
use App\Models\UserNotifications;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Notifications\NewTransaction;
use App\Notifications\NewReview;
use App\Notifications\AdminResponse;
use App\Notifications\UpdateProof;
use App\Notifications\UpdateStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class TransactionsController extends Controller
{
    /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
    */


    public function  construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $user = Auth::id();
        $cart = session('checkout');
        $discount = Discount::get();
        $province = Province::pluck('title', 'province_id');
        $courier = Courier::pluck('courier', 'id');
        return view('checkout', compact('cart', 'user','province', 'courier', 'discount'));
    }

    public function adminIndex()
    {
        $transactions = Transactions::with('user')->orderBy('created_at', 'DESC')->get();
        return view('admin.transactions', compact('transactions'));
    }

    public function transactionDetails($id)
    {
        $transactions = Transactions::with('user')->with('courier')->where('id', $id)->first();
        return view('admin.detail_transactions', compact('transactions', 'id'));
    }

    public function approve($id)
    {
        Transactions::where('id', $id)
                ->update([
                    'status' => 'verified'
                ]);

        $transaction = Transactions::where('id', $id)->first();
        $transaction_detail = TransactionDetails::where('transaction_id', $id)->get();
        $user = User::find($transaction->user_id);

        foreach ($transaction_detail as $detail) {
            $product = Product::where('id', $detail->product_id)->first();
            Product::where('id', $detail->product_id)
                ->update([
                    'stock' => $product->stock - $detail->qty
            ]);
        }

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan terverifikasi!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan terverifikasi!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('/transaction');
    }

    public function delivered($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        $user = User::find($transaction->user_id);
        Transactions::where('id', $id)
                ->update([
                    'status' => 'delivered'
                ]);   

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan dikirim!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan dikirim!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('/transaction');
    }

    public function canceled($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        $user = User::find($transaction->user_id);
        Transactions::where('id', $id)
                ->update([
                    'status' => 'canceled'
                ]);
                  
        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> 'Admin',
            'message'=>'membatalkan pesanan!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan dibatalkan!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('/transaction');
    }

    public function expired($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        $user = User::find($transaction->user_id);
        Transactions::where('id', $id)
                ->update([
                    'status' => 'expired'
                ]);

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan expired!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan expired!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('/transaction');
    }

    public function orderTimeout($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        $user = User::find($transaction->user_id);
        Transactions::where('id', $id)
                ->update([
                    'status' => 'expired'
                ]);

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan expired!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan expired!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('myorder');
    }

    public function orderSuccess($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        $user = User::find($transaction->user_id);

        Transactions::where('id', $id)
                ->update([
                    'status' => 'success'
                ]);

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan diterima!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan diterima!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('myorder');
    }

    public function orderCancel($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        $user = User::find($transaction->user_id);

        Transactions::where('id', $id)
                ->update([
                    'status' => 'canceled'
                ]);

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> $user->name,
            'message'=>'membatalkan pesanan!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Pesanan dibatalkan!',
            'id'=> $id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('myorder');
    }
    
    public function getKota($id)
    {
        $city = City::where('province_id', $id)->pluck('title', 'city_id');
        return json_encode($city);
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
    */


    public function getCost(Request $request) {
        $url = 'https://api.rajaongkir.com/starter/cost';
        $client = new Client();
        
        $messages = [
            'not_in' => ':attribute belum dipilih!',
            'required' => ':attribute belum diisi!',
            'min' => ':attribute minimal :min karakter!',
            'numeric' => ':attribute hanya angka!',
        ];

        $request->validate([
            'product_id' => 'required',
            'name' => 'min:5',
            'phone' => 'numeric|min:10',
            'alamat' => 'required',
            'provinsi' => 'not_in:0',
            'kota' => 'not_in:0',
            'kurir' => 'not_in:0',
            'payment' => 'not_in:0',
        ], $messages);

        $courier_name = Courier::where('id', $request->kurir)->first('courier');
        $getRegency = City::where('city_id', $request->kota)->first('title');
        $getProvince = Province::where('province_id', $request->provinsi)->first('title');

        $getCost = $client->request('POST', $url, 
        [
            'headers' => [
                'key' => 'c4267eb2dc0020aee5262bc61cdb044b',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'origin' => 114,
                'destination' => $request->kota,
                'weight' => $request->weight,
                'courier' => strtolower($courier_name->courier),
            ]
        ]);

        $cost = json_decode($getCost->getBody(), true);
        $date = Carbon::now('Asia/Makassar');
        
        $timeout = $date->addHours(24);
        $address = $request->alamat;
        $regency = $getRegency->title;
        $province = $getProvince->title;
        $shipping_cost = $cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        $total = $request->subtotal + $shipping_cost;
        $sub_total = $request->subtotal;
        $user_id = Auth::id();
        $courier_id = $request->kurir;
        
        $transaksi = Transactions::create([
            'timeout' => $timeout,
            'address' => $address,
            'regency' => $regency,
            'province' => $province,
            'total' => $total,
            'shipping_cost' => $shipping_cost,
            'sub_total' => $sub_total,
            'user_id' => $user_id,
            'courier_id' => $courier_id,
            'created_at' => $date,
            'status' => 'unverified'
        ]);
        
        $transaksi_id = $transaksi->id;
        $product = $request->product_id;

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> Auth::user()->name,
            'message'=>'melakukan transaksi!',
            'id'=> $transaksi_id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $user = User::find($transaksi->user_id);
        $data = [
            'nama'=>Auth::user()->name,
            'message'=>'Upload bukti pembayaran!',
            'id'=>$transaksi_id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);
        
        foreach ($product as $product_id) {
            $user_id = Auth::id();
            $totalDiscount = 0;
            $getProduct = Product::where('id', $product_id)->first();
            $cart = Cart::with('product')->where('product_id', $product_id)->where('status', 'notyet')->first();
            $discount = Discount::where('id_product', $product_id)->get();
            foreach($discount as $discounts) {
                $totalDiscount += $discounts->percentage;
            }
            TransactionDetails::create([
                'transaction_id' => $transaksi_id,
                'product_id' => $product_id,
                'qty' => $cart->qty,
                'discount' => $totalDiscount,
                'selling_price' => $cart->product->price
            ]);
            Cart::where('product_id', $product_id)->where('user_id', $user_id)->where('status', 'notyet')
                ->update([
                    'status' => 'checkedout'
                ]);
        }
        return redirect('myorder');
    }

    /**
        * Store a newly created resource in storage.
        *
        * @param \Illuminate\Http\Request $request
        * @return \Illuminate\Http\Response
    */

    public function myOrder()
    {
        $user_id = Auth::id();
        $transaction = Transactions::with('user')->with('courier')->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return view('myorder', compact('transaction'));
    }

    public function storePayment(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $messages = [
            'required' => 'Bukti pembayaran belum diupload!',
            'image' => 'Upload hanya gambar bukti pembayaran!',
            'max' => 'Batas ukuran gambar hanya :max MB',
            'mimes' => 'Upload file sesuai ekstensi :mimes'

        ];

        $request->validate([
            'payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages);
        
        $imageName = time().'_.'.$request->payment->extension();
        $request->payment->move(public_path('payment/'), $imageName);
        //$imageName = Storage::putFile('public_html/payment',$request->payment);

        Transactions::where('id', $request->transaction_id)
                ->update([
                    'proof_of_payment' => basename($imageName)
                ]);

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> $user->name,
            'message'=>'mengupload bukti pembayaran!',
            'id'=> $request->transaction_id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Bukti pembayaran diupload!',
            'id'=> $request->transaction_id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('myorder')->with("success", "Bukti pembayaran berhasil diupload!");
    }
}
