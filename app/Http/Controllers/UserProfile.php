<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class UserProfile extends Controller
{
    public static function userProfile()
    {
        $photo = request('profile');
        // dd($photo);
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

            // $path=$photo->store('uploads');
            $path = $photo->store('uploads');
            $url = Storage::url($path);
            $localPath = storage_path('app/private/' . $path);
            $upload = new UploadApi();
            $result = $upload->upload($localPath);
            $secureUrl = $result->offsetGet('secure_url');
            $ses = session()->get('user');
            $email = $ses['email'];
            $data = DB::table('users')->where('email', $email)->update([
                'photo' => $secureUrl
            ]);
            //    dd("data",$secureUrl);
            session()->put('profile',$secureUrl);
            return redirect()->back();
        }
    }

    public  function userHistory(Request $request)
    {

        $user_id =  DB::table('users')->where('email', $request->user_email)->value('id');
        $user_data = DB::table('providers_user')->where('user_id', $user_id)->get();
        $review_data = DB::table('review')->where('user_id', $user_id)->get();

        $length = count($user_data);

        $user_hisory = [];
        $r_data = [];
        for ($i = 0; $i < $length; $i++) {

            $user_id_from_providers_user = $user_data[$i]->user_id; //1
            $provider_id_from_providers_user = $user_data[$i]->provider_id; //1

            $user_id_from_review;
            $provider_id_from_review;

            if (isset($review_data[$i])) {

                // $r_data.push($review_data[$i]);
                array_push($r_data, $review_data[$i]);
                $user_id_from_review = $review_data[$i]->user_id;
                $provider_id_from_review = $review_data[$i]->providers_id;

                if ($user_id_from_providers_user == $user_id_from_review && $provider_id_from_providers_user == $provider_id_from_review) {
                    $user_hisory[] = [
                        'user_id'    => $user_data[$i]->user_id,
                        'provider_id' => $user_data[$i]->provider_id,
                        'task_id'    => $user_data[$i]->id,
                        'status'     => $user_data[$i]->status,
                        'amount'     => $user_data[$i]->amount,
                        'review_id'  => $review_data[$i]->review_id,
                        'review_data'    => $review_data[$i]->review
                    ];
                }
            }
        }

        session()->put('user_history', $user_hisory);
        return redirect('/user/history');
    }
}
