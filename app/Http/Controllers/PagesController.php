<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SubscriptionPlan;
use App\Models\Plugin;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = '';

        $total_user = User::all()->count();
        $total_plan = SubscriptionPlan::all()->count();
        $total_plugin = Plugin::all()->count();
        $total_order = Order::all()->count();
        $user = Auth::user();
        $active_plan =  SubscriptionPlan::find($user->active_plan);
        $active_plan_name = 'Free';
        if($active_plan){
            $active_plan_name = $active_plan->plan_name;
        }

        return view('pages.dashboard', compact('page_title', 
        'page_description', 'total_user', 'total_plan','total_plugin', 'total_order', 'active_plan_name'));
    }


    public function userIndex()
    {
        $page_title = 'Dashboard';
        $page_description = '';

        $total_user = User::all()->count();
        $total_plan = SubscriptionPlan::all()->count();
        $total_plugin = Plugin::all()->count();
        $total_order = Order::all()->count();
        $user = Auth::user();
        $active_plan =  SubscriptionPlan::find($user->active_plan);
        $active_plan_name = 'Free';
        if($active_plan){
            $active_plan_name = $active_plan->plan_name;
        }

        return view('user-dashboard.dashboard', compact('page_title', 
        'page_description', 'total_user', 'total_plan','total_plugin', 'total_order', 'active_plan_name'));
    }


    

    /**
     * Demo methods below
     */

    // Datatables
    public function datatables()
    {
        $page_title = 'Datatables';
        $page_description = 'This is datatables test page';

        return view('pages.datatables', compact('page_title', 'page_description'));
    }

    // KTDatatables
    public function ktDatatables()
    {
        $page_title = 'KTDatatables';
        $page_description = 'This is KTdatatables test page';

        return view('pages.ktdatatables', compact('page_title', 'page_description'));
    }

    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('pages.select2', compact('page_title', 'page_description'));
    }

    // jQuery-mask
    public function jQueryMask()
    {
        $page_title = 'jquery-mask';
        $page_description = 'This is jquery masks test page';

        return view('pages.jquery-mask', compact('page_title', 'page_description'));
    }

    // custom-icons
    public function customIcons()
    {
        $page_title = 'customIcons';
        $page_description = 'This is customIcons test page';

        return view('pages.icons.custom-icons', compact('page_title', 'page_description'));
    }

    // flaticon
    public function flaticon()
    {
        $page_title = 'flaticon';
        $page_description = 'This is flaticon test page';

        return view('pages.icons.flaticon', compact('page_title', 'page_description'));
    }

    // fontawesome
    public function fontawesome()
    {
        $page_title = 'fontawesome';
        $page_description = 'This is fontawesome test page';

        return view('pages.icons.fontawesome', compact('page_title', 'page_description'));
    }

    // lineawesome
    public function lineawesome()
    {
        $page_title = 'lineawesome';
        $page_description = 'This is lineawesome test page';

        return view('pages.icons.lineawesome', compact('page_title', 'page_description'));
    }

    // socicons
    public function socicons()
    {
        $page_title = 'socicons';
        $page_description = 'This is socicons test page';

        return view('pages.icons.socicons', compact('page_title', 'page_description'));
    }

    // svg
    public function svg()
    {
        $page_title = 'svg';
        $page_description = 'This is svg test page';

        return view('pages.icons.svg', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}