<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Fa
use Illuminate\Support\Facades\Storage;
class ProviderProfile extends Controller{
    public static function upload (Request $request){
        if($request->hasFile('profile')){
            $id=GetProviderId::getId($request);
            // dd("returned id",$id);

            $path=$request->profile->store('/uploads');
            // Storage::disk('local')->put('example.txt', 'Contents');
            dd("it works",$path);
        }
        dd(session()->all());
        dd("no file");
        
        // return view('profile');
    }
}