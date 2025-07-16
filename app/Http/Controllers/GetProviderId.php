<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;


class GetProviderId extends Controller
{
    public static function getId(Request $request)
    {
        $provider_mail = $request->cookie('provider_cookie');

        $provider_value = Service::where('email', $provider_mail)->first();
        // dd($provider_value[0]);
        return $provider_value['id'];
    }
}
