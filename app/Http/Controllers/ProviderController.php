<?php

namespace App\Http\Controllers;

use App\Clearance;
use App\Provider;
use App\Http\Requests\ProviderRequest;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the Provs
     *
     * @param  \App\Provider  $model
     * @return \Illuminate\View\View
     */
    public function index(Provider $model)
    {
        $clients = Clearance::all();

        return view('clearance.index', compact('clients'));
    }

    /**
     * Show the form for creating a new Prov
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('providers.create');
    }
    public function print($id)
    {
        //
//        dd($id);

        $admins=DB::table('bills')->where('id',$id)->first();
//        dd($admins);
        $bills =DB::table('bill__services')
            ->join('services', 'services.id', '=', 'bill__services.product_id')
            ->select('bill__services.*', 'services.name')
            ->where('bill__services.order_id',$id)->get();

//     dd($bills);
        return view('providers.create', compact('admins','bills'));
    }

    /**
     * Store a newly created Provider in storage
     *
     * @param  \App\Http\Requests\ProviderRequest  $request
     * @param  \App\Provider  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProviderRequest $request)
    {
        dd($request);
        $provider->create($request->all());

        return redirect()
            ->route('providers.index')
            ->withStatus('Successfully Registered Vendor.');
    }

    /**
     * Show the form for editing the specified Provider
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\View\View
     */
    public function edit(Provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        $transactions = $provider->transactions()->latest()->limit(25)->get();

        $receipts = $provider->receipts()->latest()->limit(25)->get();

        return view('providers.show', compact('provider', 'transactions', 'receipts'));
    }

    /**
     * Update the specified Provider in storage
     *
     * @param  \App\Http\Requests\ProviderRequest  $request
     * @param  \App\Provider  $Provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());

        return redirect()
            ->route('providers.index')
            ->withStatus('Provider updated successfully.');
    }

    /**
     * Remove the specified Provider from storage
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();

        return redirect()
            ->route('providers.index')
            ->withStatus('Provider removed successfully.');
    }
}
