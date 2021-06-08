<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Response;
use App\Models\ProductReviews;
use App\Models\Admin;
use App\Models\User;
use App\Models\AdminNotifications;
use App\Models\UserNotifications;
use Auth as Auth;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $productReview = ProductReviews::with('product')->with('user')->get();
        // $response = Response::with('product_review')->with('admin')->get();
        return view('admin.review_product', compact('productReview'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'response' => ['required'],
        ]);

        $review = ProductReviews::with('user')->where('id', $request->review_id)->first();
        $user = User::find($review->user_id);

        $response = new Response();
        $response->review_id = $request->review_id;
        $response->admin_id = $request->admin_id;
        $response->content = $request->response;
        $response->save();

        //Notif Admin
        $admin = Admin::find(1);
        $data = [
            'nama'=> 'Admin',
            'message'=>'Response dikirim!',
            'id'=> $request->review_id,
            'category' => 'review'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User
        $data = [
            'nama'=> $user->name,
            'message'=>'Review diresponse!',
            'id'=> $review->product_id,
            'category' => 'review'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('/review');
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'response_edit' => ['required'],
        ]);

        $response=new Response();
        $response=Response::find($id);
        $response->content = $request->response_edit;
        $response->save(); 
        return redirect("/review");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response=new Response();
        $response=Response::find($id);
        $response->delete(); 
        return redirect("/review");
    }

    public function notif($id) 
    {
        $notification = AdminNotifications::find($id);
        $notif = json_decode($notification->data);
        $date = Carbon::now('Asia/Makassar');
        AdminNotifications::where('id', $id)
                ->update([
                    'read_at' => $date
                ]);
        
        if ($notif->category == 'transaction') {
            return redirect()->route('transactions.detail', $notif->id);
        } elseif ($notif->category == 'review') {
            return redirect('/review');
        } 
    }
}
