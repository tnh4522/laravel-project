<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\GuestController;
use App\Http\Controllers\FrontEnd\MemberController;
use App\Http\Controllers\FrontEnd\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SearchProductController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

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

Auth::routes();
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['admin']
], function () {
    //admin
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('logout', [DashboardController::class, 'logout']);
    //admin:user
    Route::get('user/profile', [UserController::class, 'index']);
    Route::post('user/profile', [UserController::class, 'update']);
    //admin:country
    Route::get('country/list', [CountryController::class, 'index']);
    Route::post('country/list', [CountryController::class, 'store']);
    Route::get('country/edit/{id}', [CountryController::class, 'show']);
    Route::post('country/edit/{id}', [CountryController::class, 'update']);
    Route::get('country/delete/{id}', [CountryController::class, 'destroy']);
    //admin:blog
    Route::get('blog/list', [BlogController::class, 'index']);
    Route::get('blog/add', [BlogController::class, 'create']);
    Route::post('blog/add', [BlogController::class, 'store']);
    Route::get('blog/edit/{id}', [BlogController::class, 'show']);
    Route::post('blog/edit/{id}', [BlogController::class, 'update']);
    Route::get('blog/delete/{id}', [BlogController::class, 'destroy']);
});

Route::group([
    'namespace' => 'FrontEnd'
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //member:logout
    Route::get('member/logout', [MemberController::class, 'logout']);
    //blog:list
    Route::get('blog/list', [\App\Http\Controllers\FrontEnd\BlogController::class, 'index']);
    //blog:detail
    Route::get('blog/detail', [\App\Http\Controllers\FrontEnd\BlogController::class, 'show']);
    //product:detail
    Route::get('product/detail/{id}', [ProductController::class, 'detail']);
    //cart
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart/add', [CartController::class, 'add']);
    Route::get('cart/check-out', [CartController::class, 'show']);
    Route::post('cart/check-out', [CartController::class, 'checkOut']);
    //test send mail
    Route::get('mail', [MailController::class, 'index']);
    //product:search
    Route::get('product', [SearchProductController::class, 'index']);
    Route::post('product/search', [SearchProductController::class, 'search']);
    Route::post('product', [SearchProductController::class, 'searchAdvanced']);
    Route::post('product/search/price', [SearchProductController::class, 'searchPrice']);

    // yêu cầu login
    Route::group(['middleware' => 'member'], function () {
        //member:account
        Route::get('member/account', [MemberController::class, 'show']);
        Route::post('member/account', [MemberController::class, 'update']);
        //member:product
        Route::get('member/product/list', [ProductController::class, 'list']);
        Route::get('member/product/create', [ProductController::class, 'create']);
        Route::post('member/product/create', [ProductController::class, 'store']);
        Route::get('member/product/edit/{id}', [ProductController::class, 'show']);
        Route::post('member/product/edit/{id}', [ProductController::class, 'update']);
        Route::get('member/product/delete/{id}', [ProductController::class, 'destroy']);
        //blog:rating
        Route::post('/blog/rating', [\App\Http\Controllers\FrontEnd\BlogController::class, 'rating']);
        //blog:comment
        Route::post('/blog/comment', [\App\Http\Controllers\FrontEnd\BlogController::class, 'comment']);
    });

    // login rồi không được vào những trang này
    Route::group(['middleware' => 'memberIsLoggedIn'], function () {
        //member:login
        Route::get('member/login', [MemberController::class, 'index']);
        Route::post('member/login', [MemberController::class, 'login']);
        //member:register
        Route::get('guest/register', [GuestController::class, 'create']);
        Route::post('guest/register', [GuestController::class, 'store']);
    });
});

