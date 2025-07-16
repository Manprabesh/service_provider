<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public static function create_user()
    {
        // dd(bcrypt(request('password'))  );
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
            return redirect('/profile')->cookie(

                "service",
                request('email'),

            );

    }

    public static function login()
    {
      
        $data=[];
        $user_value = User::where('email', request('email'))->first();
        // dd($user_value);

        // foreach ($user_value as $user) {
        //     $data[]=['data'=>$user->email];
        // }
        /* Compare the user login password and the db passaword for authentication 
        */
        // dd("user password->",request('password'));
        if(password_verify(request('password'),$user_value['password'])){
            return redirect('/profile')->cookie("service",request('email'));
        }
        else{
            return redirect('/');
        }
       
    }
}
