<?php

namespace App\Http\Controllers;

use App\Admission;
use App\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Admission::all();
        $client=2;
     //   $clients= DB::table('admissions');
      //$clients=  DB::table('admisions');
//        dd($clients);

        //dd($clients);
      //  return view('games', [
         //   'games' => ['Castlevania', 'Galaga', 'Ghosts n Goblins'];

          //  $games=array(['nairobi','kisumu']); $cars= array(1 => 'one', 2 => 'two', 3 => 'three');
        //$cars = array("Volvo", "BMW", "Toyota");

        //dd($cars);

        return view('uphome.index', compact('clients','client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories =ProductCategory ::all();
        $counties= array(
        1 => 'NAIROBI', 2 => 'KISUMU', 3 => 'KIAMBU');

        $subcounties= array(
            1 => 'LIMURU', 2 => 'KIKUYU', 3 => 'LARI','GITHUNGURI');

        return view('uphome.create', compact('categories','counties','subcounties'));
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
//        dd($request);
        $curr_date=$request->date_admitted;
        $curr_date=Carbon::now();

//
//        dd($cur_date);
        $admit = new Admission();
       $user=Auth::user()->name;


        $admit->name_of_deceased = $request->name_of_deceased;
        $admit->name = $request->name;
        $admit->id_no= $request->id_no;
        $admit->home_area = $request->home_area;
        $admit->tel_no = $request->tel_no;
        //$admit->date_admitted= $request->date_admitted;
        $admit->date_admitted=$request->date_admitted;
        $admit->permit_no = $request->permit_no;
        $admit->relationship = $request->relationship;
        $admit->tel_no2=$request->tel_no2;
        $admit->user_name=$user;
        $admit->save();
        return redirect()
            ->route('admission.index')
            ->withStatus('Admission successfully registered.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Admission $admission)
    {
        //
     //$clients=$admission->get();
       // $user = DB::table('users')->where('name', 'John')->first();
        $admins=DB::table('admissions')->where('id',$admission->id)->first();
//     dd($admins->id);
        return view('uphome.show', compact('admins'));

    }
    public function print( $id)
    {
        //
//        dd($id);
        $admins=DB::table('admissions')->where('id',$id)->first();

//     dd($admins);
        return view('uphome.show', compact('admins'));
    }
    public function print2()
    {
        //
//        $id=2;
//        dd($id);
//        $admins=DB::table('admissions')->where('id',$id)->first();

//     dd($admins);
        return view('uphome.show2');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $id=$id;
        $admin=Admission::find($id);

        return view('uphome.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admission $admission)
    {
        //
//        dd($request);
     $id=$request->id;
//        $url = $request->fullUrl();
//        dd($id);
        $klijent = Admission::find($id);

        $klijent->update($request->all());
//        $permit = $request->get('permit_no');
//        dd($permit);s

//        $request->merge(['password' => Hash::make($request->get('password'))]);

//        $request->except([$hasPassword ? '' : 'password']);

//        $admission->update($request->all());

        return redirect()->route('admission.index')->withStatus('Admission successfully updated.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admission $admission)
    {
        //
    }
}
