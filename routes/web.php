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
use Illuminate\Http\Request;


Route::get('/login', function () {
    return view('login');
});

Route::controller(AuthController::class)->group(
    function () {

        Route::post('signup', 'create_user')->name('signup');
        Route::post('user-login', 'login')->name('user-login');

    }
);

Route::post('/search/service', [Search_service::class, 'services']);

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


// Route::controller(BookSevice::class)->group(
//     function () {
       
        
//     }
//     )->middleware(EnsureTokenIsValid::class);
    
    Route::post('/book/service', [BookSevice::class,'book'])->middleware(EnsureTokenIsValid::class);;
Route::post('/provider/auth', [providerAuth::class, 'login']);


Route::post('/upload-photo', [ProviderProfile::class, 'upload']);

Route::get('/dashboard', [ProviderDashboard::class, "serve"]);


Route::get('/task',function(Request $request){
    return view('serviceTask');
});

