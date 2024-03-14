<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = 'All Users';
        $page_description = '';
        $all_users = User::all();

        return view('pages.users.users', compact('page_title', 'page_description','all_users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'All Users';
        $page_description = '';
        $all_plans = SubscriptionPlan::all();
        return view('pages.users.create', compact('page_title', 'page_description', 'all_plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'active_plan' => 'required',
            'user_role_name' => 'required',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:3|confirmed'
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'user_role_name' => $request->user_role_name,
            'active_plan' => $request->active_plan,
            'password' => Hash::make($request->password)
        ]);

     
        // $request->session()->regenerate();
        return redirect()->route('user.all')
        ->withSuccess('You have successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    public function myProfile()
    {

        $page_title = 'My Profile';
        $page_description = '';
        $user = Auth::user();
        $plan = SubscriptionPlan::find($user->active_plan);
        return view('pages.users.my-profile', compact('page_title', 'page_description', 'user', 'plan'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        // dd($id);
        $page_title = 'Edit User';
        $page_description = '';
        $user_data = User::find($id);
        // dd($user_data);
        $all_plans = SubscriptionPlan::all();
        // echo '<pre>';
        // print_r($user->id);
        // echo '</pre>';

        return view('pages.users.edit', compact('page_title', 'page_description','user_data', 'all_plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());

        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
        ]);
        $user = User::findOrFail($id);

        $user->fill($request->only(['first_name', 'last_name', 'email', 'active_plan']));

        if ($request->filled('password')) {

            $user->password = bcrypt($request->password);

        }

        $user->save();
        
        return redirect()->route('user.all')->with('success', 'Profile updated successfully.');
    }



    public function updateMyProfile(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'required',
        ]);

        
        $user = User::findOrFail(Auth::user()->id);

        $user->fill($request->only(['first_name', 'last_name', 'email']));

        // if ($request->filled('password')) {

        //     $user->password = bcrypt($request->password);

        // }

        $user->save();
        
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }




    public function changePasswordView()
    {
        return view('user-dashboard.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Password Updated Successfully');

        }else{


            return redirect()->back()->withErrors(['msg' => 'Current Password does not match with Old Password']);
        }
    }
}
