<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Cloudinary;


class ProviderAccount extends Controller
{
    public static function createAccount()
    {
        $email = request('email');
        $name = request('name');
        $nationality = request('nationality');
        $dob = request('dob');
        $phone = request('phone');
        $town = request('town');
        $pincode = request('pincode');
        $distric = request('distric');
        $pan_no = request('pan_no');
        $adhar_no = request('adhar_no');
        $experience = request('experience');
        $about = request('about');
        $service_type = request('service_type');
        $price = request('price');
        $photo = request('photo');
        $review = request('review');
        $password = request('password2');

        Log::info("all details ->", [$name, $email, $nationality, $dob, $town, $pincode, $distric, $adhar_no, $pan_no, $experience, $about, $service_type, $about, $price, $photo, $review]);

        $secureUrl = '';
        $providers = new Providers;


        if ($photo) {
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => 'dhbkfleac',
                    'api_key' => '338358144134781',
                    'api_secret' => '3Ti_FPO0ZjLtPzE5jSZ3bTmrjF4'
                ],
                'url' => [
                    'secure' => true
                ]
            ]);
            $path = $photo->store('uploads');
            $url = Storage::url($path);
            $localPath = storage_path('app/private/' . $path); // absolute local file path
            $upload = new UploadApi();
            $result = $upload->upload($localPath);
            $secureUrl = $result->offsetGet('secure_url'); 
            $providers->photo = $secureUrl;

            // Log::info("Secure URL: " . $secureUrl);
        }


        $providers->name = $name;
        $providers->email = $email;
        $providers->DOB = $dob;
        $providers->pincode = $pincode;
        $providers->price = $price;
        $providers->review = $review;
        $providers->service_type = $service_type;
        $providers->adhar_no = $adhar_no;
        $providers->pan_no = $pan_no;
        $providers->phone = $phone;
        $providers->distric = $distric;
        $providers->nationality = $nationality;
        $providers->experience = $experience;
        $providers->about = $about;
        $providers->town = $town;

        $providers->save();

        $user_value = Providers::where('email', $email)->first();
        $id2 = $user_value['id'];
        // dd( "value",$id2);
        /**
         *  Create a seesion from the above data
         *  id, name, email, 
         */
        /**
         * ToDo
         * create a session from -> id, name, email
         * save the session value in db
         * and the session id as cookie
         * 
         */

        session()->put('session_key', $email);// what happening here
        $sessionId = session()->getId();
        if ($user_value) {
            $data="hello";
            Log::info("user id ->",[$data]);
            $result=  DB::table('sessions')->where('id', $sessionId)->update([
                'user_id' => $user_value['id']
            ]);
            // dd("set",$result);
        } else {
            // handle error
            dd("User not found");
        }

        $session = DB::table('sessions')->where('id', session()->getId())->first();
        $data = unserialize(base64_decode($session->payload));
        // dd("base payload",base64_decode($session->payload));

        //send a email for account verification
        /**
         * Do it later
         */

        // return view('password');

        $cookie = cookie('_provider_', $sessionId);
        return redirect('/login')->cookie($cookie);
        // dd("uploaded to database");


    }
    public static function sendEmail()
    {
        dd("send email");
    }
    public static function password()
    {
        dd("password", request('password2'));
    }

    public static function login()
    {
        // dd("hello"); 
        $ck = request()->cookie("_provider_");
        $session = DB::table('sessions')->where('id', $ck)->first();
        $data = unserialize(base64_decode($session->payload));

        dd($data);

    }
}
