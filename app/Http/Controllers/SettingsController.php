<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Braintree\Transaction;
use Braintree\Customer;
use Braintree\ClientToken;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
    	return view('settings.home')
    		->with('user', $request->user())
    		->with('client_token', ClientToken::generate());
    }

    public function saveBilling(Request $request)
    {
        $request->validate([
            'payment_method_nonce' => 'required'
        ]);

        $customer = Customer::create([
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'firstName' => (explode(' ', $request->user()->name))[0],
            'lastName' => (explode(' ', $request->user()->name))[1]
        ]);

        if($customer->success)
        {
            $request->user()->braintree_id = $customer->customer->id;
            $request->user()->save();

            return redirect()->route('settings')->with('success', 'Updated payment information!');
        }

        return redirect()->route('settings')->with('error', 'Error Occured: Error while communicating with PayPal');
    }
}
