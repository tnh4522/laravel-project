<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'Api'
], function () {
    //member
    Route::post('/login',[MemberController::class, 'login']);
    Route::post('/register',[MemberController::class, 'register']);
    //product
    Route::get('/product',[ProductController::class, 'productHome']);
    Route::get('/product/list',[ProductController::class, 'productList']);
    Route::get('/product/wishlist',[ProductController::class, 'productWishList']);
    Route::get('/product/detail/{id}',[ProductController::class, 'detail']);
    Route::post('/product/cart',[ProductController::class, 'productCart']);
    //blog
    Route::get('blog/list', [BlogController::class, 'list']);
    Route::get('blog/detail', [BlogController::class, 'detail']);
    Route::get('blog/rate/{id}', [BlogController::class, 'getRating']);
    // category-brand
    Route::get('/category-brand',[CategoryController::class, 'listCategoryBrand']);

    //middleware
    Route::middleware(['auth:sanctum'])->group(function (){
        Route::post('blog/rate/{id}', [BlogController::class, 'rating']);
        Route::post('blog/comment/{id}', [BlogController::class, 'comment']);
        //member
        Route::post('/user/update/{id}',[MemberController::class, 'update']);
        Route::get('/user/my-product',[ProductController::class, 'myProduct']);
        Route::post('/user/product/add',[ProductController::class, 'store']);
        Route::get('/user/product/{id}',[ProductController::class, 'show']);
        Route::post('/user/product/update/{id}',[ProductController::class, 'update']);
        Route::get('/user/product/delete/{id}',[ProductController::class, 'delete']);
    });
});
