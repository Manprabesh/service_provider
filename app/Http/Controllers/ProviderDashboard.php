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

        if (!$provider_mail) {
            return;
        }

        // dd("hello");

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
            $list_of_user[] = [
                'user_id' => $serviceModel->id,
                'name' => $serviceModel->name,
                'email' => $serviceModel->email,

                'status' => $pivotData
            ];
        }

        return view('providerDashboard', [
            "users" => $list_of_user
        ]);
        // dd("provider mail", $provider_mail);
    }

    public static function dashboardData(Request $request)
    {
        $session_id = $request->cookie('_provider_');
        Log::info("provider dashboard", [$session_id]);


        if ($session_id) {
            $result = DB::table('sessions')->where('id', $session_id)->first();

            if ($session_id == $result->id) {

                $data = unserialize(base64_decode($result->payload));
                $provider_email ="" ;
                
                if($data["email"]){
                    // dd($data);
                    $provider_email = $data["email"];
                    
                }
                else{
                    $provider_email = $data['provider']["email"];
                    // dd($data);
                    
                }
                $providers_id = DB::table('providers')->where('email', $provider_email)->value('id');
                $pivot_table_data = DB::table('providers_user')->where('provider_id', $providers_id)->get();
                $review_data = DB::table('review')->where('providers_id', $providers_id)->get();
                // dd($pivot_table_data);
                $pivot_data = [];
                $length = count($pivot_table_data);

                for ($i = 0; $i < $length; $i++) {
                    $pivot = $pivot_table_data[$i];
                    $user_email = DB::table('users')->where('id', $pivot->user_id)->value("email");

                    if (isset($review_data[$i])) {
                        $r_data = $review_data[$i]->review;
                    } else {
                        $r_data = null;
                    }

                    $email = $user_email;
                    $pivot_data[] = [
                        'money' => $pivot->amount,
                        'status' => $pivot->status,
                        'user_email' => $email,
                        'review_data' => $r_data
                    ];
                }

                // dd($pivot_data);


                return response()->json([
                    ['data' => $pivot_data],
                ]);
            } else {
                return response()->json("Login");
            }
        } else {
            return response()->json("Login");
        }
    }
}
