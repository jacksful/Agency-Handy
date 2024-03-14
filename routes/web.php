<?php

use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', 'AuthController@index')->name('login');
Route::post('/post-login', 'AuthController@postLogin')->name('login.post'); 
Route::get('/signup', 'AuthController@signup')->name('user.signup');
Route::post('/post-signup', 'AuthController@postSignup')->name('signup.post'); 
Route::get('/', 'FrontEndController@index');


Route::get('/forgot-password', function () {
    return view('auth.forget');
})->middleware('guest')->name('password.request');


Route::post('/forgot-password', 'AuthController@forgetPasswordReq')->name('request.forget'); 




Route::middleware(['auth','verified'])->group(function () {
    Route::get('/purchase-plan/{id}', 'OrderController@checkout')->name('purchase.plan');
    Route::get('/success-payment/{seion_id}', 'OrderController@success')->name('checkout.success');
    Route::get('/cancel-payment', 'OrderController@cancel')->name('checkout.cancel');
    
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', 'UserController@logout')->name('logout');
});





// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect('/dashboard');
// })->middleware(['auth', 'signed'])->name('verification.verify');



// Route::post('/email/verification-notification', function (Request $request) {
//     // dd($request->user());
//     $send = $request->user()->sendEmailVerificationNotification();

//     // dd($send);
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::controller(VerificationController::class)->group(function() {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', 'PagesController@userIndex')->name('user.dashboard');
        Route::get('/my-plugins', 'PluginController@myPlugins')->name('myplugin');
        Route::get('/get-activation-code', 'PluginCodeController@show')->name('get.activation.code');
        Route::get('/my-payment-history', 'OrderController@userOrderHistory')->name('my.paymenthistory');
        Route::get('change-password', 'UserController@changePasswordView')->name('my.passwordchange');
        Route::post('change-password', 'UserController@changePassword')->name('my.updatepassword');
    });
});


Route::prefix('dashboard')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', 'PagesController@index')->name('dashboard');
        
        Route::get('/download-plugin/{id}', 'PluginController@downloadFile')->name('download.file');
        
        // Route::get('/get-activation-code', 'PluginCodeController@userOrderHistory')->name('get.activation.code');

        

        Route::get('/my-profile', 'UserController@myProfile')->name('my.profile');
        Route::post('/update-profile', 'UserController@updateMyProfile')->name('update.myprofile');

        
        
    });
    
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/all-orders', 'OrderController@index')->name('all.orders');
        Route::get('/payment-settings', 'PaymentGatewayController@create')->name('payment.settings');

        Route::post('/store-paymentsetting', 'PaymentGatewayController@store')->name('create.paymentsetting');

        

        
        Route::get('/all-subscription-plan', 'SubscriptionPlanController@index')->name('plan.index');
        Route::get('/all-users', 'UserController@index')->name('user.all');
        Route::get('/edit-user/{id}', 'UserController@edit')->name('edit.user');
        Route::post('/update-user/{id}', 'UserController@update')->name('update.user');
        Route::get('/create-user', 'UserController@create')->name('create.user');
        Route::post('/store-user', 'UserController@store')->name('store.user');


        Route::get('/all-plugins', 'PluginController@index')->name('all.plugin');

        
        
        Route::get('/create-plugin', 'PluginController@create')->name('create.plugin');
        
        Route::post('/store-plugin', 'PluginController@store')->name('plugin.store');

        Route::get('/activation-code', 'PluginCodeController@index')->name('activation.code');
       
        // Route::get('/store-code', 'PluginCodeController@create')->name('store.code');

       
        
        Route::get('/create-subscription-plan', 'SubscriptionPlanController@create')->name('plan.create');
        
        Route::post('/store-subscription-plan', 'SubscriptionPlanController@store')->name('plan.post');
        // Demo routes
        Route::get('/datatables', 'PagesController@datatables');
        Route::get('/ktdatatables', 'PagesController@ktDatatables');
        Route::get('/select2', 'PagesController@select2');
        Route::get('/jquerymask', 'PagesController@jQueryMask');
        Route::get('/icons/custom-icons', 'PagesController@customIcons');
        Route::get('/icons/flaticon', 'PagesController@flaticon');
        Route::get('/icons/fontawesome', 'PagesController@fontawesome');
        Route::get('/icons/lineawesome', 'PagesController@lineawesome');
        Route::get('/icons/socicons', 'PagesController@socicons');
        Route::get('/icons/svg', 'PagesController@svg');

        // Quick search dummy route to display html elements in search dropdown (header search)
        Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

        
    });

});


// Auth::routes(['verify' => true]);





