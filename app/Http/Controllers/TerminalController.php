<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CommandSubmitJob;
use App\Container;

class TerminalController extends Controller
{
    public function terminal(Request $request, $hash)
    {
        $container = Container::where('user_id', '=', $request->user()->id)->where('hash', '=', $hash)->get()->first();
        if($container === null)
        {
            return redirect()->route('containers');
        }

        return view('containers.terminal')->with('container', $container);
    }

    public function submitCommand(Request $request, $hash)
    {
        $container = Container::where('hash', '=', $hash)->get()->first();
        if($container === null)
        {
            return response()->json([
            	'status' => 'fail', 
            	'message' => 'unable to locate container with specified hash']
            , 404);
        }

        $request->validate([
            'input_command' => 'required'
        ]);

        dispatch(new CommandSubmitJob(
            $container,
            $request->input('input_command')
        ))->onQueue('high');

        return response()->json([
        	'status' => 'success', 
        	'message' => 'submitted command to containers queue'
        ], 200);
    }
}
