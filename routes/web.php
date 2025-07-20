<?php
use App\Http\Controllers\ProviderProfile;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Search_service;
use App\Http\Controllers\BookSevice;
use App\Http\Controllers\ProviderAuth;
use App\Http\Controllers\ProviderDashboard;
// use App\Http\Controllers\providerProfile;



Route::post('/search/service', [Search_service::class, 'services']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware(EnsureTokenIsValid::class);


Route::get('/service', function () {
    return view('service');
})->middleware(EnsureTokenIsValid::class);

Route::get('users/export/', [UserController::class, 'export']);


Route::controller(UserController::class)->group(
    function () {
        Route::get('users', 'index');
        Route::get('users-export', 'export')->name('users.export');
        Route::post('users-import', 'import')->name('users.import');
    }
)->middleware(EnsureTokenIsValid::class);


Route::controller(AuthController::class)->group(
    function () {

        Route::post('signup', 'create_user')->name('signup');
        Route::post('login', 'login')->name('login');

    }
)->middleware(EnsureTokenIsValid::class);


Route::controller(BookSevice::class)->group(
    function(){
        Route::get('task','get_services');
        Route::post('/book/service','book');
        
    }
);


Route::post('/provider/auth',[providerAuth::class,'login']);

Route::get('/provider-profile',function(){
    return view("providerProfile");
});

Route::post('/upload-photo',[ProviderProfile::class,'upload']);

Route::get('/dashboard',[ProviderDashboard::class,"serve"]);