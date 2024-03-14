<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use App\Models\Plugin;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use App\Traits\Upload; //import the trait
use Throwable;

class PluginController extends Controller
{
    use Upload;//add this trait
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = 'All Plugins';
        $page_description = '';
        $all_Plugin = Plugin::all();

        return view('pages.plugins.index', compact('page_title', 'page_description','all_Plugin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Upload New Plugin';
        $page_description = '';
        $all_plans = SubscriptionPlan::all();
        return view('pages.plugins.create', compact('page_title', 'page_description', 'all_plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'plan_id' => 'required',
            'file' => 'required'
        ]);
        // dd($request->hasFile('file'));


        try {
            if ($request->hasFile('file')) {
                $path = $this->UploadFile($request->file('file'), 'Products');//use the method in the trait
                Plugin::create([
                    'name' => $request->name,
                    'file_path' => $path,
                    'plan_id' => $request->plan_id
                ]);
                return redirect()->route('all.plugin')->with('success', 'Plugin Uploaded Successfully');
            }
            return redirect()->back()->withErrors(['msg' => 'Something Wrong!']);
        } catch (Throwable $e) {
      
            return redirect()->back()->withErrors(['msg' => $e]);
            // return false;
        }
        
        

  
    }


    public function myPlugins()
    {
        $page_title = 'My Plugins';
        $page_description = '';

        $user = Auth::user();
        $my_plugins =  Plugin::where('plan_id', $user->active_plan)->get();
        // dd($my_plugins);
        

        return view('user-dashboard.myplugins', compact('page_title', 'page_description', 'my_plugins'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Plugin $plugin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plugin $plugin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plugin $plugin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plugin $plugin)
    {
        //
    }


    public function downloadFile($plugin_id)
    {
        $plugin = Plugin::find($plugin_id);

        if(Auth::user()->active_plan == $plugin->plan_id){
            return $this->returnFile($plugin->file_path);
        }else{
            return redirect()->back()->withErrors(['msg' => 'You have no permission to download this plugin!']);
            
        }
        
        
    }

    public function returnFile($file)
    {
        $path = storage_path('app/public/'.$file);
        // dd($path);
        try {
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (FileNotFoundException $exception) {
            return redirect()->back()->withErrors(['msg' => 'Something wrong!']);
        }
    }

    
    
}
