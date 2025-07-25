<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Search_service extends Controller
{
    public function services()
    {
        // dd(request('service_name'));

        $service_data = DB::table('providers')->where('service_type', request('service_name'))->get();

        /**
         * Craft the object data to send back
         */

        // dd($service_data);

        $service_to_send=[];
        foreach($service_data as $data){
            $service_to_send[]=[
                'service_provice_id'=>$data->{'id'},
                'name'=>$data->{'name'},
                'service_type'=>$data->{'service_type'},
                'price'=>$data->{'price'},
                'email'=>$data->{'email'},
                'phone'=>$data->{'phone'},
                'photo'=>$data->{'photo'}
            ];
        }
        // dd("service to send",$service_to_send);

        if (!count($service_data)) {
            return redirect()->back()->with('null',"There is no search services")->withInput();;
        } else {
            // dd($service_data);
                        return redirect()->back()->with('myData',$service_to_send)->withInput();;
            // dd($service_data[0]->{'service_name'});
        }
    }
}
