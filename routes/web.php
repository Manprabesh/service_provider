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
use App\Http\Controllers\UserProfile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
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

/**
 * Need some changes in the users/export
 */
Route::get('users/export/', [UserController::class, 'export']);


Route::controller(UserController::class)->group(
    function () {
        Route::get('users', 'index');
        Route::get('users-export', 'export')->name('users.export');
        Route::post('users-import', 'import')->name('users.import');
    }
)->middleware(EnsureTokenIsValid::class);


Route::post('/book/service', [BookSevice::class, 'book'])->middleware(EnsureTokenIsValid::class);

Route::post('/upload-photo', [ProviderProfile::class, 'upload']);

Route::get('/dashboard', [ProviderDashboard::class, "serve"]);

Route::get('/provider/dashboard-data', [ProviderDashboard::class, "dashboardData"]);

Route::post('/user/profile-photo', [UserProfile::class, 'userProfile']);

Route::get('/user/data/history', [UserProfile::class, 'userHistory'])->middleware(EnsureTokenIsValid::class);

Route::get('/user/history', function (Request $request) {
    return view('userHistory');
})->middleware(EnsureTokenIsValid::class);

Route::post('/task/{status}', function () {

    $url = request()->path();
    $status = str_replace("task/", "", $url);
    $pv_id = request('pv_id');
    DB::table('providers_user')->where('id', $pv_id)->update([
        'status' => $status
    ]);

    return redirect('/user/data/history');

})->middleware([EnsureTokenIsValid::class]);

Route::post('/upload/review', function () {
    $provider_id = request('provider');
    $user_id = request('user');
    $review_id = request('review_id');
    $review =  request('user_review');

    $r_data = DB::table('review')->where('review_id', $review_id)->update(['review' => trim($review)]);
    // dd($r_data);
    // return redirect('/user/history');
    return redirect('/user/data/history');

});

Route::get('/provider/login', function () {
    return view('providerLogin');
});

Route::get('/provider/dashboard', function () {
    return view('providerDashboard');
});
