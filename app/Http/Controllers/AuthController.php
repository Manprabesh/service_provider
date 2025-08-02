<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public static function create_user()
    {

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        session()->put('user', ['email' => request('email')]);
        $sessionId = session()->getId();
        $cookie = cookie('_user_', $sessionId);

        return redirect('/profile')->cookie(
            $cookie
        );
    }

    public static function login()
    {

        $user_value = User::where('email', request('email'))->first();

        if (!$user_value) {
            return back()->with('response', 'Email or password is incorrect');
        }

        $user_hash_password = $user_value->password;

        if (password_verify(request('password'), $user_hash_password)) {
            $user_id = $user_value->id;
            $user_data = DB::table('users')->where('email', request('email'))->first();

            session()->put('user', ['email' => request('email')]);
            session()->save();
            $sessionId = session()->getId();
            // $updated_table = DB::table('sessions')->where('id',$sessionId)->update(['user_id'=>$user_id]);
            $cookie = cookie('_user_', $sessionId);
            // dd("photo",$user_data->photo);
            session()->put('profile', $user_data->photo);
            return redirect('/profile')->cookie($cookie);
        } else {
            return back()->with('response', 'Email or password is incorrect');
        }
    }
}
