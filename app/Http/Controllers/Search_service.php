<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Search_service extends Controller
{
    public function services()
    {

        $service_data = DB::table('providers')->where('service_type', request('service_name'))->get();

        /**
         * Craft the object data to send back
         */

        $service_to_send = [];
        foreach ($service_data as $data) {
            $service_to_send[] = [
                'service_provice_id' => $data->{'id'},
                'name' => $data->{'name'},
                'service_type' => $data->{'service_type'},
                'price' => $data->{'price'},
                'email' => $data->{'email'},
                'phone' => $data->{'phone'},
                'photo' => $data->{'photo'}
            ];
        }


        if (!count($service_data)) {
            return redirect()->back()->with('null', "There is no search services")->withInput();
        } else {
            return redirect()->back()->with('myData', $service_to_send)->withInput();
        }
    }
}
