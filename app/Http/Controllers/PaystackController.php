<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriptions;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Unicodeveloper\Paystack\Paystack;
use App\User;
use Illuminate\Support\Facades\App;
use Auth;

class PaystackController extends Controller
{
    public function payWithPaystack()
    {
        return view('clients.paystack');
    }
    
    public function redirectToGateway(Request $request)
    {
        // dd($request->input('reference'));
        // dd( $request->all());
        return $this->paystack->getAuthorizationUrl()->redirectNow();
    }
    // public function handleGatewayCallback(Request $request)
    public function getPaymentStatus(Request $request)
    {
      
        $paymentDetails = $this->paystack->getPaymentData();
        dd($paymentDetails);
    }

    public function __construct()
    {
        $this->paystack = new Paystack();
    }
}
