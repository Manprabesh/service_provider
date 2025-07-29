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


    Route::post('/book/service', [BookSevice::class,'book'])->middleware(EnsureTokenIsValid::class);;
Route::post('/provider/auth', [providerAuth::class, 'login']);


Route::post('/upload-photo', [ProviderProfile::class, 'upload']);

Route::get('/dashboard', [ProviderDashboard::class, "serve"]);
Route::get('/provider/dashboard-data', [ProviderDashboard::class, "dashboardData"]);


Route::get('/task',function(Request $request){
    return view('serviceTask');
});

Route::post('/user/profile-photo',[UserProfile::class,'userProfile']);
Route::get('/user/data/history',[UserProfile::class,'userHistory'])->middleware(EnsureTokenIsValid::class);

Route::get('/user/history',function(){
   return view('userHistory');
});

Route::get('/task/{status}',function(){
        $url=request()->path();
       $status= str_replace("task/","",$url);
        $pv_id=request('pv_id');
        DB::table('providers_user')->where('provider_id',$pv_id)->update([
            'status'=>$status
        ]);
   dd($status);
});

Route::post('/upload/review',function(){
    $provider_id=request('provider');
    $user_id=request('user');
    $review =  request('user_review');

    $result=DB::table('review')->insert([
        'review'=>$review, 
        'providers_id'=>$provider_id,
        'user_id'=>$user_id
    ]);

    DB::table('providers_user')->where( 'provider_id',$provider_id)->update(['review'=>'data']);

    dump("results", $result);

    dump("provider",$provider_id);
    dump("user",$user_id);
    dd('revew',$review);
});
Route::get('/provider/login',function()
{
    return view('providerLogin');   
});

Route::get('/provider/dashboard',function(){
    return view('providerDashboard');
});

