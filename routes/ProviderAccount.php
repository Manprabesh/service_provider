<?php
use App\Http\Middleware\EnsureTokenIsValid;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderAccount;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Callback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log ;
use App\Models\User;
// Route::get('/providerAuth',function(){
//     return view('providerAuth');
// });

Route::controller(ProviderAccount::class)->group(
    function () {

        Route::get('/provider/create/account', function () {
            return view("providerAuth");
        });
        Route::get('/password', function () {
            return view('password');
        });
        Route::get('/provider/profile', function () {
            return view('providerProfile');
        });
        Route::post('/provider/create/account', 'createAccount')->name('create_account');

        Route::post('/password', 'password')->name('password');
  
        
    }
);

Route::get('/service/{show}', [ServiceController::class, 'read_service']);

Route::post('/done',[Callback::class,'cb'])->middleware(EnsureTokenIsValid::class);;


