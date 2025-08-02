<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class EnsureTokenIsValid
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->cookie('_user_')) {
            $session_id = $request->cookie('_user_');

            $result = DB::table('sessions')->where('id', $session_id)->first();
            if ($result->id) {
                if ($request->cookie('_user_') == $result->id) {
                    $data = unserialize(base64_decode($result->payload));
                    try {
                        $data['user']["email"];
                    } catch (\Throwable $th) {

                        return redirect('/');
                    }

                    // dd();
                    $user_email = $data['user']["email"];

                    $request->user_email = $user_email;

                    return $next($request);
                }
            }
        } else {
            return redirect('/login');
        }

        // return $next($request);
    }
}
