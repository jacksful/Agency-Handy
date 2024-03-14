<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $page_title = 'All Plans';
        $page_description = '';
        $all_plans = SubscriptionPlan::all();

        return view('pages.subscriptionplan.index', compact('page_title', 'page_description','all_plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.subscriptionplan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_name' => 'required|max:255',
            
          ]);
        //   SubscriptionPlan::create($request->all());

          $plan = new SubscriptionPlan();
            $plan->plan_name = $request->plan_name;
            $plan->plan_details = $request->plan_details;
            $plan->price =  $request->price;
            $plan->stripe_payment_link =  $request->stripe_payment_link;
            $isActive = true;
            if($request->is_active == 'off'){
                $isActive = false;
            }
            $plan->is_active =  $isActive;
            $plan->save();
          return redirect()->route('plan.index')
            ->with('success', 'Plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionPlan $subscriptionPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        //
    }
}
