<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.signup');
    }


    

    public function postLogin(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');

        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            if(auth()->user()->user_role_name != 'admin'){
                return redirect()->route('user.dashboard')
                ->withSuccess('You have Successfully loggedin');
            }

            return redirect()->route('dashboard')
            ->withSuccess('You have Successfully loggedin');
            
        }
  

        return redirect()->route("login")->withSuccess('Oppes! You have entered invalid credentials');
    }



    public function postSignup(Request $request)
    {
        // dd($request);
        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:3|confirmed'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        
        event(new Registered($user));
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('verification.notice');
        // return redirect()->route('login')
        // ->withSuccess('You have successfully registered, Please verify your email to login!');
    }





    public function forgetPasswordReq(Request $request)
    {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
        dd($status);
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    


    

    
}
