<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            "_user_",
            request('email'),

        );

    }

    public static function login()
    {

        $user_value = User::where('email', request('email'))->first();
        $user_hash_password = $user_value->password;
       

        if (!$user_value) {

            return back()->with('response', 'Email or password is incorrect');

        }

        if (password_verify(request('password'), $user_hash_password)) {
            $user_id = $user_value->id;
            session()->put('user', ['email' => request('email')]);
            session()->save(); 
            $sessionId=session()->getId();
            // dump("session id",$sessionId);
            $updated_table = DB::table('sessions')->where('id',$sessionId)->update(['user_id'=>$user_id]);


            $cookie = cookie('_user_', $sessionId);

            return redirect('/profile')->cookie($cookie);

        } 
        
        else {

            return back()->with('response', 'Email or password is incorrect');

        }

    }
}
