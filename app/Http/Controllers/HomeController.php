<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function user()
    // {
    //     return view('user');
    // }

    // public function admin()
    // {
    //     return view('admin');
    // }

    public function index()
    {
        $products_data = Product::get();
        return view('beranda',compact('products_data'));
    }
}
