<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

//list model yang digunakan
use App\Models\Courier;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menampilkan daftar kurir
        $courier = Courier::all();
        return view ('admin.read_courier_list',compact (['courier']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Menampilkan halaman untuk menambahkan data kurir
        return view ('admin.create_courier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //menyimpan data kurir
        if(Courier::where('courier',$request->courier)->exists()){
            return redirect('/courier')->with('gagal','Data kurir sudah terdaftar!');
        }
        $courier = new Courier;
        $courier->courier = $request->courier;
        $courier->save();
        return redirect('/courier')->with('berhasil','Data kurir berhasil ditambahkan!');
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
        //menampilkan halaman edit
        $courier=Courier::where('id',$id)->first(); 
        return view ('admin.edit_courier',compact(['courier']));
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
        Courier::where('id',$id)->update([
            'courier'=>$request->courier,
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
        ]);
        return redirect('/courier')->with('berhasil','Data kurir berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data kurir
        $courier=Courier::find($id);
        $courier->delete();
        return redirect('/courier')->with('berhasil','Data kurir berhasil dihapus!');
    }
}
