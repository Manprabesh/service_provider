<?php

namespace App\Http\Controllers;
use App\Models\Service;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProviderDashboard extends Controller
{
    public static function serve(Request $request)
    {

        $provider_mail = $request->cookie('provider_cookie');

        $provider_value = Service::where('email', $provider_mail)->first();
        $service_book_by_user = DB::table('service_user')->where('service_id', $provider_value['id'])->get();
        // dd("service booked",$service_book_by_user);
        $arr_of_users = [];
        foreach ($service_book_by_user as $values) {
            $user_id = $values->{'user_id'};
            $status = $values->{'status'};

            Log::info("user ID", [$values->{'user_id'}]);

            $user = User::find($user_id);
            $arr_of_users[] = [$user, $status];

        }
        // dd("with status append",$arr_of_users);
        $list_of_user = [];
        for ($i = 0; $i < count($arr_of_users); $i++) {
            // dd("arr of users",$arr_of_users[$i][1]);
            $serviceModel = $arr_of_users[$i][0];
            $pivotData = $arr_of_users[$i][1];
            // dd('pivot data',$pivotData);
            // dd('seviceModel',$serviceModel);
            $list_of_user[] = [
                'user_id' => $serviceModel->id,
                'name' => $serviceModel->name,
                'email' => $serviceModel->email,
                // 'price' => $serviceModel->price,
                'status' => $pivotData
            ];
        }
        // Cookie::make("provider_cookie","value");
        // dd("list of user",$list_of_user);

        return view('providerDashboard', [
            "users" => $list_of_user
        ]);
        // dd("provider mail", $provider_mail);
    }
}
