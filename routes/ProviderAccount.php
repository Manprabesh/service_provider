<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderAccount;
use App\Http\Controllers\ServiceController;

// Route::get('/providerAuth',function(){
//     return view('providerAuth');
// });

Route::controller(ProviderAccount::class)->group(
    function(){

        Route::get('/provider/create/account',function(){
            return view("providerAuth");
        });
        Route::get('/password',function(){
            return view('password');
        });Route::get('/provider/profile',function(){
            return view('providerProfile');
        });
         Route::post('/provider/create/account','createAccount')->name('create_account');
         
         Route::post('/password','password')->name('password');
         Route::post('/login','login');
         Route::get('/login',function(){
            return view('providerLogin');
         });
        }
    );

    Route::get('/service/{show}',[ServiceController::class,'read_service']);