<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Search_service extends Controller
{
    public function services()
    {
        $service_data = DB::table('services')->where('service_name', request('service_name'))->get();

        /**
         * Craft the object data to send back
         */

        // dd($service_data);

        $service_to_send=[];
        foreach($service_data as $data){
            $service_to_send[]=[
                'service_provice_id'=>$data->{'id'},
                'name'=>$data->{'name'},
                'service_name'=>$data->{'service_name'},
                'price'=>$data->{'price'},
                'email'=>$data->{'email'}
            ];
        }
        // dd($service_to_send);

        if (!count($service_data)) {
            dd("null");
        } else {
            // dd($service_data);
                        return redirect()->back()->with('myData',$service_to_send)->withInput();;
            // dd($service_data[0]->{'service_name'});
        }
    }
}
