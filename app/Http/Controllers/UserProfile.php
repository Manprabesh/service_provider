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
        $photo=request('profile');
// dd($photo);
if($photo){
        Configuration::instance([
          'cloud' => [
                    'cloud_name' => 'dhbkfleac',
                    'api_key' => '338358144134781',
                    'api_secret' => '3Ti_FPO0ZjLtPzE5jSZ3bTmrjF4'
                ],
            'url'=>[
                'secure'=>true
            ]
        ]);

        // $path=$photo->store('uploads');
         $path = $photo->store('uploads');
            $url = Storage::url($path);
        $localPath = storage_path('app/private/' . $path);
 $upload = new UploadApi();
 $result = $upload->upload($localPath);
  $secureUrl = $result->offsetGet('secure_url');
           $ses= session()->get('user');
           $email=$ses['email'];
          $data= DB::table('users')->where('email',$email)->update([
            'photo'=> $secureUrl
           ]);
        //    dd("data",$data);
        return redirect()->back()->with('profile',$secureUrl);
    }
    }

    public static function userHistory(Request $request)
    {
        // dd($request->user_email);

        
        $user_id =  DB::table('users')->where('email',$request->user_email)->value('id');
        $user_data=DB::table('providers_user')->where('user_id', $user_id)->get();
        $review_data= DB::table('review')->where('user_id', $user_id)->get();
        
// dd('review', $review_data);
       if($review_data){

           foreach($review_data as $review)
            {
                // dump("review ->", $review->review);
            }
        }
        // dump("userdata", $user_data);
        // dd("review data", $review_data);


$length=count($user_data);
// dd($length);
$user_hisory = [];
for($i = 0;$i < $length;$i++){
 
    $user_id_from_providers_user = $user_data[$i]->user_id;
    $provider_id_from_providers_user = $user_data[$i]->provider_id;
$user_id_from_review;
 $provider_id_from_review;
    if(isset($review_data[$i])){
        
        $r_data = $review_data[$i];
        $user_id_from_review = $r_data->user_id;
        $provider_id_from_review = $review_data[$i]->providers_id;

        if($user_id_from_providers_user == $user_id_from_review && $provider_id_from_providers_user==$provider_id_from_review)
        {
        // dd("match");
        $user_hisory[] = [
        'user_id'    => $user_data[$i]->user_id,
        'provider_id'=> $user_data[$i]->provider_id,
        'status'     => $user_data[$i]->status,
        'amount'     => $user_data[$i]->amount,
        'review_status'  => $user_data[$i]->review,
        'review_data'    => $review_data[$i]->review
            
        ];
        }

    }

    else{

    $user_hisory[] = [
        'user_id'    => $user_data[$i]->user_id,
        'provider_id'=> $user_data[$i]->provider_id,
        'status'     => $user_data[$i]->status,
        'amount'     => $user_data[$i]->amount,
        'review_data'    => null,
        'review_status'  => $user_data[$i]->review,
        
    ];
    }

}
// dd("you");
// dd($user_hisory);
return redirect('/user/history')->with(
'user_history', $user_hisory
);
    }
}
