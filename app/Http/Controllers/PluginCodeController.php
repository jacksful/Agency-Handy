<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Throwable;

class PluginCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $plugin_code = Auth::user()->licience_code;  

        $all_users = User::all();
        // dd($all_orders);

        $page_title = 'Users Activation Code';
        $page_description = '';

        return view('pages.plugins.plugincode', compact('page_title', 'page_description','all_users'));
    }

   

    /**
     * Display the specified resource.
     */
    public function show()
    {

        $plugin_code = Auth::user()->licience_code;  

        
         
        // dd($all_orders);

        $page_title = 'Activation Code';
        $page_description = '';

        if(Auth::user()->active_plan){
            return view('user-dashboard.myactivationcode', compact('page_title', 'page_description','plugin_code'));
        }

        return redirect()->route('myplugin');

        
    }



    public function verify($code)
    {

        // $plugin_code = Auth::user()->licience_code;  
        $data = [
            'success' => false,
            'message' => 'Invalid Code',
        ];

        $codeData = User::where('licience_code', $code)->first(); 
        $statusCode = 404;
        if($codeData){
            $data = [
                'success' => true,
                'message' => 'Verify Successfully',
            ];
            $statusCode = 200;
        } 

        

    
        return response()->json($data, $statusCode);
         
       

        
    }

}
