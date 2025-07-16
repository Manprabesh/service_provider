<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class BookSevice extends Controller
{
    public static function book(Request $request)
    {

        /* 
        -> Got the email of the service provider
        */
        $service_data = DB::table('services')->where('email', request('service_email'))->get();

        $service_provider_id = $service_data[0]->{'id'};
        Log::info("providers id ->", [$service_provider_id => ['status' => 'pending']]);

        // dd("service datta", gettype($service_provider_id));

        /**
         *-> Got the user email via cookie
         *   
         **/

        $value = $request->cookie('service');

        /**
         * Check and get the user details from db
         */

        $user_details = Db::table('users')->where('email', $value)->get('id');

        $user_id = $user_details[0]->{'id'};

        /**
         * Get the user from db by the id
         */
        $user = User::find($user_id);
        // dd("--",[$service_provider_id][0]);
        $user->services()->attach([$service_provider_id => ['status' => 'pending']]);

        $service_book_by_user = DB::table("service_user")->where('user_id', $user_id)->get();

        // dd("servie list", count($values));

        $list_of_services = [];
        //return all the services that a user has booked

        $service = [];
        foreach ($service_book_by_user as $values) {

            Log::info("-_______________-");

            $id = $values->{'service_id'};
            $status = ["status" => $values->{'status'}];
            Log::info("status", [$status]);
            $service_providers = Service::find($id);
            Log::info("Service providers ->", [$service_providers]);
            $service[] = [$service_providers, $status];
            // $service[] = $status;
        }

        for ($i = 0; $i < count($service); $i++) {
            $serviceModel = $service[$i][0];
            $pivotData = $service[$i][1];

            $list_of_services[] = [
                'service_id' => $serviceModel->id,
                'service_name' => $serviceModel->service_name,
                'email' => $serviceModel->email,
                'price' => $serviceModel->price,
                'status' => $pivotData['status']
            ];
        }

        return view('task', [
            "services" => $list_of_services,

        ]);
    }
    public static function get_services(Request $request)
    {
        $value = $request->cookie('service');

        $user_details = Db::table('users')->where('email', $value)->get();

        $service_book_by_user = DB::table("service_user")->where('user_id', $user_details[0]->{'id'})->get();

        // dd("service book by user ->",$service_book_by_user);

        $list_of_services = [];
        //return all the services that a user has booked

        $service = [];
        foreach ($service_book_by_user as $values) {
            // dd($values);
            Log::info("-_______________-");
            // Log::info($values->{'service_id'});
            $status = ["status" => $values->{'status'}];

            $id = $values->{'service_id'};
            $service_providers = Service::find($id);
            // Log::info("Service providers ->", [$service_providers]);
            $service[] = [$service_providers, $status];

        }
        // dd($service[6]['id']);
        for ($i = 0; $i < count($service); $i++) {
            $serviceModel = $service[$i][0];
            $pivotData = $service[$i][1];

            $list_of_services[] = [
                'service_id' => $serviceModel->id,
                'service_name' => $serviceModel->service_name,
                'email' => $serviceModel->email,
                'price' => $serviceModel->price,
                'status' => $pivotData['status']
            ];
        }

        return view('task', [
            "services" => $list_of_services
        ]);
    }
}
