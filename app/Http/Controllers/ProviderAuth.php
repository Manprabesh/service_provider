<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Cookie;

class ProviderAuth extends Controller
{
    public static function login()
    {
        
        $provider_value = Service::where('email', request('email'))->first();
        // dd($provider_value);
        if (!$provider_value) {
            return view('providerAuth')->with('failed', "No user exist");

        } else {

            return redirect('/dashboard')->cookie("provider_cookie",request('email'));

            //get the details of the service provider to whom it is serving
            
        }

    }
}
