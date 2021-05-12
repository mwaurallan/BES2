<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Bill;
use App\Bill_Service;
use App\Clearance;
use App\Service;
use App\Transact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $client=0;
        $products = Service::all();
        $clients = Admission::all();
        $bills = Bill::all();
        $bills = DB::table('bills')
            ->join('admissions', 'admissions.id', '=', 'bills.customer_email')
            ->select('bills.*', 'admissions.name', 'admissions.name_of_deceased')
            ->orderBy('id', 'asc')->get();

//        dd($bills);

        return view('payments.index', compact('products', 'bills','client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clients = Admission::all();
        $products = Service::all();
        $bills = Bill::all();

        return view('payments.create', compact('clients', 'products', 'bills'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $admins = DB::table('bills')->where('customer_email', $request->customer_name)->get();

        if ($admins->isNotEmpty()) {
//do something
//            dd($admins);
            if

            ($bill_balance = $admins[0]->bill_balance > 0) {
                return redirect()->route('services.index')->withStatus('There is an existing bill with balance.');
            }

        }
        $id = $request->customer_name;
        $client = DB::table('admissions')->where('id', $id)->first();
        $name = $client->name;
        $id2 = $client->id;
        $total = 0;
        $products = $request->input('products', []);
        $quantities = $request->input('quantities', []);
        foreach ($quantities as $order) {
            $total += $order;
        }
        //dd($total);

        Bill::create([
            'customer_name' => $name,
            'customer_email' => $id2,
            'bill_total' => $total,
            'bill_balance' => $total,
        ]);

        $id2 = Bill::latest()->first();
        $id2 = $id2->id;

//        $products = $request->input('products', []);
//        $quantities = $request->input('quantities', []);

        //  for($i = 0;$i<count($products);$si++){
        for ($product = 0; $product < count($products); $product++) {
            // for ($quantity=0;$quantity< count( $products); $quantity++) {
            Bill_Service::create([
                'order_id' => $id2,
                'product_id' => $products[$product],
                'quantity' => $quantities[$product]
            ]);
        }


        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill, $id)
    {

//        dd($id);
        $bill = Bill::findOrFail($id);
//        dd($bill->customer_email);
//        $clear=Clearance::findOrFail($bill->customer_email);
        $clear = DB::table('clearances')->where('adm_no', $bill->customer_email)->get();
//        dd($clear[0]->adm_no);
//        dd($clear);
        if ($clear->isNotEmpty()) {

            return redirect()->route('services.index')->withStatus('Cant delete  a bill with clearance.');
//            dd($clear[0]->adm_no);
        }
        $user=Auth::user()->name;
        $type='Bill';
        $bill->services()->delete();
        $bill->payments()->delete();
        $bill->delete();
//        $user=Auth::user()->name;
        Transact::create([
            'type' => $type,
            'trans_id'=>$id,
            'trans_amount'=>$bill->bill_total,
            'deleted_by'=>$user,
        ]);

        return redirect()->route('services.index')->withStatus(' bill'.$id.' Deleted succesfully.');

    }
}
