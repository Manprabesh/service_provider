<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->cookie()) {

            // dd("cookie");
            $value = $request->cookie('cookie_name');
            // $value is already decrypted
            // dd($value);
            // return redirect('/profile');
            return $next($request);
            // dd("if cookie ->",$request->cookie('service_provider'));


        } else {
            // dd("else cookie ->",$request->cookie('cookie_name'));
            return redirect('/');

        }

        // return $next($request);
    }
}
