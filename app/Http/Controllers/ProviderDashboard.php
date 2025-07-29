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

        // dd($provider_mail);
        if(!$provider_mail){
            return;
        }

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

    public static function dashboardData(Request $request){
        $session_id=$request->cookie('_provider_');

        if($session_id){
            $result=DB::table('sessions')->where('id',$session_id)->first();
            if($session_id == $result->id){

            //get money details transaction table
            //get provider and status details provider_user table
            //get review details review table
            //get user details review table

               $data = unserialize(base64_decode($result->payload));

                $provider_email=$data['provider']["email"];
            
                $providers_id = DB::table('providers')->where('email',$provider_email)->value('id');

                $pivot_table_data=DB::table('providers_user')->where('provider_id',$providers_id)->get();

                $review_data=DB::table('review')->where('providers_id',$providers_id)->get();
                // dd("review data", $review_data[2]->review);
                $pivot_data=[];

                foreach($pivot_table_data as $pivot){
                    // dump($pivot->amount);
                  
                }
$length=count($pivot_table_data);
                for($i=0;$i<$length;$i++){
                  if (isset($review_data[$i])) {
    $r_data = $review_data[$i]->review;
}
else{
    $r_data="no data";
}
                        $pivot_data[]=[
                        'money'=>$pivot->amount,
                        'status'=>$pivot->status,
                        'review_state'=>$pivot->review,
                        'review_data'=>$r_data
                        ];

                }

            //    dump('pivot data',$pivot_data);



                return response()->json([
                ['data' => $pivot_data],
            ]); 
            }
            else{
                return response()->json("Login");
            }
            
        }
        else{
            return response()->json("Login");

        }
        
    }
}
