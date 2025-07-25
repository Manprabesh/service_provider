<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class EnsureTokenIsValid
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->cookie('_user_')) {
            $session_id=$request->cookie('_user_');
           $result= DB::table('sessions')->where('id',$session_id)->first();
           if($request->cookie('_user_')==$result->id){
               $data = unserialize(base64_decode($result->payload));
               $user_email=$data['user']["email"];
            //    dd($user_email);
         $request->user_email=$user_email;
        //  dd($request);
               return $next($request);
           }

        } else {
            return redirect('/login');

        }

        // return $next($request);
    }
}
