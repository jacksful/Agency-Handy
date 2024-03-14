<?php

namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paymentSettings = PaymentGateway::first();  
        // dd($all_orders );

        $page_title = 'Gateway Settings';
        $page_description = '';

        return view('pages.payment-gateway.settings', compact('page_title', 'page_description','paymentSettings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'public_key' => 'required|string|max:250',
            'secret_key' => 'required|string|max:250',
        ]);

        $paymentSettings = PaymentGateway::first();  
        $paymentSettings->public_key =  $request->public_key;
        $paymentSettings->secret_key = $request->secret_key;
        $paymentSettings->save();
     
        // $request->session()->regenerate();
        return redirect()->back()
        ->withSuccess('Update successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentGateway $paymentGateway)
    {
        //
    }
}
