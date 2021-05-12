<?php

namespace App\Http\Controllers;

use App\Clearance;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients = Clearance::all();

        return view('clearance.index', compact('clients'));
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
    public function print($id)
    {
        //
//        dd($id);
        $counties= array(
            1 => 'NAIROBI', 2 => 'KISUMU', 3 => 'KIAMBU');

        $subcounties= array(
            1 => 'LIMURU', 2 => 'KIKUYU', 3 => 'LARI','GITHUNGURI');

       $pay= Payment::query()
            ->where('customer_id', '=',$id)
           ->join('bills', 'bills.id', '=', 'payments.order_id')
           ->select('payments.*', 'bills.bill_balance')
           ->latest('id')
           ->first();

       if(is_null($pay)){
           return redirect()
               ->route('admission.index')
               ->withStatus('Admission has no active bills');
       }


        $bills =DB::table('admissions')
            ->where('admissions.id',$id)->get();

        $results = Payment::latest('id')
            ->where('customer_id','=',$id)->first();

        $rct_id=$results->id;

        if ($pay->bill_balance == null) {
            return view('clearance.create', compact('bills', 'counties', 'subcounties', 'rct_id'));
        } else{
                return redirect()
                    ->route('clearance.index')
                    ->withStatus('Admissions  has pending balance.');
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\
     * Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request);
        $user = Clearance::where('adm_no', '=',$request->adm_no)->first();
        if ($user === null) {
            $curr_date=$request->release_date;
            $curr_date=Carbon::now();
//
            $admit= new Clearance();
//        $user=Auth::user()->name;
            $user=Auth::user()->name;
            $admit->name_of_deceased = $request->name_of_deceased;
            $admit->adm_no= $request->adm_no;
            $admit->next_of_kin = $request->name;
            $admit->id_no= $request->id_no;
            $admit->permit_no = $request->permit_no;
            $admit->county = $request->county;
            $admit->subcounty = $request->subcounty;
            $admit->location= $request->location;
            $admit->village = $request->village;
            $admit->nearest_centre = $request->nearest_centre;
            $admit-> nearest_police= $request->nearest_police;
            $admit-> witness= $request->witness;
            $admit-> witness_id= $request->witness_id;
            $admit-> auth_officer= $request->auth_officer;
            $admit-> release_officer= $request->release_officer;
            $admit-> release_date=  $curr_date;
            $admit->rct_no=$request->rct_no;
            $admit->save();
            return redirect()
                ->route('clearance.index')
                ->withStatus('Clearance successfully registered.');

        }
        else{
            return redirect()
                ->route('clearance.index')
                ->withStatus('Clearance Exists.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clearance  $clearance
     * @return \Illuminate\Http\Response
     */
    public function show(Clearance $clearance)
    {
        //
    }
    public function print5( $id)
    {
        //
//        dd($id);
//        $results = Payment::latest('id')
//            ->join('bills')
//            ->where('customer_id','=',$id)->first();
//        dd($results);
        //$admins=DB::table('bills')->where('id',$id)->first();

        $clients=DB::table('clearances')->where('id',$id)->first();
//        dd($clients);

//     dd($clients->name_of_deceased);
        return view('clearance.show', compact('clients'));
    }
    public function print6()
    {

        return view('clearance.show2');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clearance  $clearance
     * @return \Illuminate\Http\Response
     */
    public function edit(Clearance $clearance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clearance  $clearance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clearance $clearance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clearance  $clearance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clearance $clearance)
    {
        //
    }
}
