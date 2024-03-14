<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    public $secret_key = '';

    public $purchese_plan_id = null;
    
    public function __construct() {
        $paymentSettings = PaymentGateway::first();  
        $this->secret_key = $paymentSettings->secret_key;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_orders = Order::with('user', 'plan')->orderBy('created_at', 'desc')->get();  
        // dd($all_orders );

        $page_title = 'All Orders';
        $page_description = '';

        return view('pages.orders.index', compact('page_title', 'page_description','all_orders'));
    }

    public function checkout($plan_id)
    {
        $plan = SubscriptionPlan::where('id', $plan_id)->first();

        $this->purchese_plan_id = $plan->id;
        // echo '<pre>';
        // var_dump($plan);
        // echo '</pre>';
        // dd();
        $user = Auth::user();
        // if($plan){

        // }



        \Stripe\Stripe::setApiKey($this->secret_key);

        // $products = Product::all();
        $lineItems = [
            [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $plan->plan_name,
                        'images' => []
                    ],
                    'unit_amount' => $plan->price * 100,
                ],
                'quantity' => 1,
            ]
        ];


       
        
        // $session = \Stripe\Checkout\Session::create([
        //     'line_items' => $lineItems,
        //     'customer_creation' => 'always',
        //     'mode' => 'payment',
        //     'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
        //     'cancel_url' => route('checkout.cancel', [], true),
        // ]);

        $order = new Order();
        $order->payment_status = 0;
        
        $order->plan_id  = $plan->id;
        $order->user_id  = $user->id;
        $order->price  = $plan->price;
        $order->session_id = '';
        $order->save();

        return redirect($plan->stripe_payment_link);
    }


    public function success($session_id)
    {
       
        // dd($request->get('session_id'));
        // \Stripe\Stripe::setApiKey($this->secret_key);
        
        // dd($session);

        // $session = \Stripe\Checkout\Session::retrieve($sessionId);
        // dd($session);

        try {
            $sessionId = $session_id;
            $stripe = new \Stripe\StripeClient($this->secret_key);
    
            $session = $stripe->checkout->sessions->retrieve($sessionId,[]);
            // $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            // dd($session);
           
            // $invoice = $stripe->invoices->create([
            //     'customer' => $session->customer,
            // ]);
            // $invoice->finalizeInvoice();

            // dd($invoice);
           
            // $invoice->pay(['paid_out_of_band' => true]);
            // dd($invoice);
            // $customer = $stripe->customers->retrieve($session->customer);
            // $invoice = \Stripe\Invoice::retrieve($invoice->id);
            
            
            

            $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
            // dd($order);

           
            
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if (!$order->payment_status) {
                $order->payment_status = 1;
                $order->session_id = $sessionId;
              
                
                $order->save();

                $id = Auth::user()->id;
                $user = User::find($id);
                $licience_code = Str::random(40);
                
                $user->active_plan = $order->plan_id;
                $user->licience_code = $licience_code;
                $user->save();
            }

            $plan = SubscriptionPlan::find($order->plan_id);

            $customer = Auth::user();

            Mail::to(Auth::user()->email)->send(new OrderMail($order,$customer,$plan));

            return view('frontend.checkout-success', compact('customer', 'order', 'plan'));
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }


    public function cancel()
    {
        return 'payment cancel';
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }


    public function userOrderHistory()
    {

        $id = Auth::user()->id;

        $all_orders = Order::with('user', 'plan')->where('user_id',$id)->orderBy('created_at', 'desc')->get();  
        // dd($all_orders);

        $page_title = 'Payment History';
        $page_description = '';

        return view('user-dashboard.myorders', compact('page_title', 'page_description','all_orders'));
        
    }


    
}
