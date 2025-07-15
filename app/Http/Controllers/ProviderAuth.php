<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ProviderAuth extends Controller
{
    public static function login()
    {
        //   dd(request('email'));
        $data = [];
        $user_value = Service::where('email', request('email'))->first();
        // dd($user_value);
        if (!$user_value) {
            return view('providerAuth')->with('failed', "No user exist");

        } else {
            //get the details of the service provider to whom it is serving
            $service_book_by_user = DB::table('service_user')->where('service_id', $user_value['id'])->get();

            $arr_of_users = [];
            foreach ($service_book_by_user as $values) {
                $user_id = $values->{'user_id'};
                // $user_id=[$values->{'user_id'}];

                // dd($user_id);
                Log::info("user ID", [$values->{'user_id'}]);

                $user = User::find($user_id);
                $arr_of_users[] = $user;
                // Log::info("Service id",$values->{'service_id'});
            }
            $list_of_user = [];
            foreach ($arr_of_users as $list) {
                $list_of_user[] = [
                    'user_id' => $list['id'],
                    'name' => $list['name'],
                    'email' => $list['email'],
                    
                ];

                Log::info($list['id']);
            }
            return view('providerDashboard',[
            "users" => $list_of_user
        ]);
        }

    }
}
