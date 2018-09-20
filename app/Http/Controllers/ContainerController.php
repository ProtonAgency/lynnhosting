<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\CreateContainer;
use App\Jobs\DestroyContainer;

use App\Location;
use App\Plan;
use App\Container;
use App\Software;

use phpseclib\Net\SSH2;
use phpseclib\Net\SFTP;

class ContainerController extends Controller
{
    public function index(Request $request)
    {
    	return view('containers.home')->with('containers', $request->user()->containers);
    }

    public function showCreateForm()
    {
    	return view('containers.new');
    }

    public function handleCreateForm(Request $request)
    {
    	$request->validate([
    		'location' => 'required|integer',
    		'plan' => 'required|integer',
            'domain' => 'required|string|unique:containers'
    	]);

    	$location = Location::find($request->input('location'));
    	$plan = Plan::find($request->input('plan'));
    	if($location === null or $plan === null)
    	{
    		return view('containers.new')->with('error', 'Unknown Location.');
    	}

    	if($request->user()->braintree_id === null)
    	{
    		return view('containers.new')->with('error', 'Please enter billing information on the Settings page');
    	}

        if($request->has('software') && $request->input('software') !== "")
        {
            $software = Software::find($request->input('software'));
            if($software === null)
            {
                return view('containers.new')->with('error', 'Unknown Pre-Install Software.');
            }
        }

        $domains = explode(',', $request->input('domain'));
        if(count($domains) > $plan->domains)
        {
            return view('containers.new')->with('error', 'Your plan only allows you to have ' . $plan->domains . ' domains. You entered ' . count($domains) . '.');
        }

        foreach($domains as $domain)
        {
            $cnt = Container::where('domain', 'like', '%' . $domain . '%')->get()->first();
            if($cnt !== null)
            {
                return view('containers.new')->with('error', 'This domain is in-use by another container.');
            }
        }

        dispatch(new CreateContainer(
            $location->id, 
            $plan->id, 
            $request->input('domain'), 
            $request->user()->id,
            $request->has('software') ? $request->input('software') : null,
            $request->has('composer') ? $request->input('composer') : null,
            $request->has('htaccess') ? $request->input('htaccess') : null
        ))->onQueue('high');

    	return redirect()->route('containers')->with('notification', 'Creating container... Please point ' . $request->input('domain') . ' to ' . $location->host . '. ' . (isset($software) ? 'It may take a few min to install ' . $software->name : ''));
    }

    public function delete(Request $request, $hash)
    {
        $container = Container::where('hash', '=', $hash)->where('user_id', '=', $request->user()->id)->get()->first();
        if($container !== null)
        {
            dispatch(new DestroyContainer(
                $container->id
            ))->onQueue('high');
        }

        return redirect()->route('containers')->with('notification', 'Container queued to be destroyed..');
    }

    public function databases(Request $request)
    {
        return view('databases.home')->with('databases', $request->user()->databases);
    }
}
