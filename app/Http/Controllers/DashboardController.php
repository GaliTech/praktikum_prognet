<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $allTransactions = Transactions::where('status', 'success')->get();
        $allSales = Transactions::where('status', 'success')->count();
        $monthlySales = Transactions::where('status', 'success')->whereMonth('created_at', $now->month)->count();
        $annualSales = Transactions::where('status', 'success')->whereYear('created_at', $now->year)->count();
        $monthlyTransactions = Transactions::where('status', 'success')->whereMonth('created_at', $now->month)->get();
        $annualTranscations = Transactions::where('status', 'success')->whereYear('created_at', $now->year)->get();
        
        $incomeTotal = 0;
        $incomeMonthly = 0;
        $incomeAnnual = 0;

        foreach ($allTransactions as $transaction) {
            $incomeTotal+=$transaction->total;
        }

        
        foreach ($monthlyTransactions as $monthly) {
            $incomeMonthly+=$monthly->total;
        }

        foreach ($annualTranscations as $annual) {
            $incomeAnnual+=$annual->total;
        }

        $january = Transactions::where('status', 'success')->whereMonth('created_at', '01')->sum('total');
        $february = Transactions::where('status', 'success')->whereMonth('created_at', '02')->sum('total');
        $march = Transactions::where('status', 'success')->whereMonth('created_at', '03')->sum('total');
        $april = Transactions::where('status', 'success')->whereMonth('created_at', '04')->sum('total');
        $may = Transactions::where('status', 'success')->whereMonth('created_at', '05')->sum('total');
        $june = Transactions::where('status', 'success')->whereMonth('created_at', '06')->sum('total');
        $july = Transactions::where('status', 'success')->whereMonth('created_at', '07')->sum('total');
        $august = Transactions::where('status', 'success')->whereMonth('created_at', '08')->sum('total');
        $september = Transactions::where('status', 'success')->whereMonth('created_at', '09')->sum('total');
        $october = Transactions::where('status', 'success')->whereMonth('created_at', '10')->sum('total');
        $november = Transactions::where('status', 'success')->whereMonth('created_at', '11')->sum('total');
        $december = Transactions::where('status', 'success')->whereMonth('created_at', '12')->sum('total');

        return view('admin.dashboard', compact('now', 'allSales', 'monthlySales', 'annualSales', 'incomeTotal', 'incomeMonthly', 'incomeAnnual', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'));
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
