<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/profile', function () {
    return view('profile');
});

// Route::get('/admin', function () {
//     return view('dashboard.home');
// });
Route::group(['middleware' => 'auth'], function () {

    // Route::group(['middleware' => ['auth', 'admin.role']], function () {
    // your admin routes here

    Route::get('/', [AdminDashController::class, 'home'])->name('home');
    // Route::get('/goal',  function () {
    //     return view('goal');
    // })->name('goal');
    Route::post('/add-user', [AdminDashController::class, 'adduser'])->name('add-user');
    // Route::get('/admin/website-customization', [AdminDashController::class, 'website_customization'])->name('website-customization');
    // Route::post('/admin/web-detail-submission', [AdminDashController::class, 'web_detail_submission'])->name('web-detail-submission');
    // Route::post('/admin/web-social-submission', [AdminDashController::class, 'web_social_submission'])->name('web-social-submission'); 

// });
    
    Route::get('/goal',[HomeController::class, 'goal']);
    Route::post('/goal',[HomeController::class, 'goal_store']);
    Route::post('/update_goal',[HomeController::class, 'update_goal']);
    Route::get('/update_status/{id}',[HomeController::class, 'update_status']);
    Route::post('/update_user',[AdminDashController::class, 'update_user']);
    Route::get('/user_destroy/{id}',[AdminDashController::class, 'user_destroy']);
});



Route::get('/register', [CustomAuthController::class, 'register'])->name('register');
Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::post('/register-submission', [CustomAuthController::class, 'register_submision'])->name('register_submision');
Route::post('/login-submission', [CustomAuthController::class, 'login_submision'])->name('login-submission');


Route::get('forget-password', [CustomAuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [CustomAuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [CustomAuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [CustomAuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


