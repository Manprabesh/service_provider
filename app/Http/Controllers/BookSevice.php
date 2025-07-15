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

        $service_data = DB::table('services')->where('email', request('service_email'))->get();



        $value = $request->cookie('service');
        $service_provider_id = 0;
        $service_provider_details = [];
        // dd(request('service_email'));
        foreach ($service_data as $service) {
            if (request('service_email') == $service->{'email'}) {
                $service_provider_id = $service->{'id'};
                // $service_provider_details[] = [
                //     'service_provider_id' => $service->{'id'},
                //     'name' => $service->{'name'},
                //     'service_name' => $service->{'service_name'},
                //     'price' => $service->{'price'},
                //     'email' => $service->{'email'}
                // ];

                break;
            }
            Log::info($service->{'id'});
            Log::info($service->{'email'});
            Log::info($service->{'service_name'});
            Log::info($service->{'name'});
            Log::info("------------------");
        }

        // dd("just existed");
        // dd($user);


        $user_details = Db::table('users')->where('email', $value)->get();
        // dd($user_details);
        // dd("user details",$user_details[0]->{'id'});
        // dd($user_details[0]->{'id'});
        $user = User::find($user_details[0]->{'id'});
        $user->services()->attach($service_provider_id);

        $service_book_by_user = DB::table("service_user")->where('user_id', $user_details[0]->{'id'})->get();

        // dd("servie list", count($values));

        $list_of_services = [];
        //return all the services that a user has booked

        $service = [];
        foreach ($service_book_by_user as $values) {
            // dd($values);
            Log::info("-_______________-");
            // Log::info($values->{'service_id'});

            $id = $values->{'service_id'};
            $service_providers = Service::find($id);
            // Log::info("Service providers ->", [$service_providers]);
            $service[] = $service_providers;

        }
        // dd($service[6]['id']);
        foreach ($service as $list) {
            $list_of_services[] = [
                'service_id' => $list['id'],
                'service_name' => $list['service_name'],
                'email' => $list['email'],
                'price' => $list['price'],
            ];

            Log::info($list['id']);
        }

        return view('task', [
            "services" => $list_of_services
        ]);
    }
    public static function get_services(Request $request)
    {
        $value = $request->cookie('service');
        $user_details = Db::table('users')->where('email', $value)->get();
        $service_book_by_user = DB::table("service_user")->where('user_id', $user_details[0]->{'id'})->get();

        $list_of_services = [];
        //return all the services that a user has booked

        $service = [];
        foreach ($service_book_by_user as $values) {
            // dd($values);
            Log::info("-_______________-");
            // Log::info($values->{'service_id'});

            $id = $values->{'service_id'};
            $service_providers = Service::find($id);
            // Log::info("Service providers ->", [$service_providers]);
            $service[] = $service_providers;

        }
        // dd($service[6]['id']);
        foreach ($service as $list) {
            $list_of_services[] = [
                'service_id' => $list['id'],
                'service_name' => $list['service_name'],
                'email' => $list['email'],
                'price' => $list['price'],
            ];

            Log::info($list['id']);
        }

        return view('task', [
            "services" => $list_of_services
        ]);
    }
}
