<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ProviderAuth extends Controller
{
    public static function login()
    {
    //   dd(request('email'));
        $data=[];
        $user_value = Service::where('email', request('email'))->first();
        // dd($user_value);
        if(!$user_value){
            return view('providerAuth')->with('failed',"No user exist");

        }

        else{
            return view('providerDashboard');
        }
       
    }
}
