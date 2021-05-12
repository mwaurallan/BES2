<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Bill_Service;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients=Admission::all();
        $products =Service::all();
        $bills=Bill::all();

        return view('payments.create', compact('clients','products','bills'));

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
    public function print( $id)
    {
        //
//        dd($id);

        $admins=DB::table('bills')->where('id',$id)->first();
//        dd($admins);
        $bills =DB::table('bill__services')
            ->join('services', 'services.id', '=', 'bill__services.product_id')
            ->select('bill__services.*', 'services.name')
            ->where('bill__services.order_id',$id)->get();
//
//
//     var_dump($admins->bill_balance);
        if ($admins->bill_balance==0){
            return redirect()->route('services.index')->withStatus('Bill has zero balance.');
        }
        return view('pay.create', compact('admins','bills'));
    }
    public function display($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);

        $admit = new Payment();
        $var = $request->payment_date;
        $var= date("Y-m-d",strtotime($var));
        $admit->order_id=$request->order_id;
        $admit->customer_id=$request->customer_email;
        $admit->payment_date=$var;
        $admit->amount_paid=$request->amount_paid;
        $admit->save();

        $bills =DB::table('bills')->where('id',$request->order_id)->first();
        $current=$bills->amount_paid;
        if($request->amount_paid == $bills->bill_balance)
        {
            $bal=$bills->bill_balance-$request->amount_paid;
        }
        else
        {
          $bal=$bills->bill_balance-$request->amount_paid;
        }
        $affected = DB::table('bills')
            ->where('id', $request->order_id)
            ->update(['amount_paid' =>$request->amount_paid +$current,'bill_balance'=>$bal]);
       $pay=Payment::latest()->first();
        $id=$pay->id;



        return redirect("print3/{$id}");


    }
    public function receipt($id)
    {
//        dd($id);
        $bills =DB::table('payments')
                  ->where('id',$id)->get();
      $client_id=$bills[0]->customer_id;
//      dd($client_id);
      $order_id=$bills[0]->order_id;
        $clients=DB::table('admissions')->where('id',$client_id)->first();
        $pays=DB::table('bills')->where('id',$order_id)->first();
        $orders =DB::table('bill__services')
            ->join('services', 'services.id', '=', 'bill__services.product_id')
            ->select('bill__services.*', 'services.name')
            ->where('bill__services.order_id',$order_id)->get();
            $total=$orders->sum('quantity');
//        dd($pays);

        return view('pay.receipt', compact('bills','clients','orders','pays','total'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
