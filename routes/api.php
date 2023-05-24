<?php

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\GeneralAPI;
use App\Http\Controllers\APIs\AuthController;
use App\Http\Controllers\APIs\ChatController;
use App\Http\Controllers\APIs\OrderController;
use App\Http\Controllers\APIs\StoreController;
use App\Http\Controllers\APIs\UserAPIOperations\ProfileAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('sendReset', 'sendReset');
    Route::post('checkCode', 'checkCode');
    Route::post('reset', 'reset');
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('logout', 'logout');
    });
});


Route::controller(GeneralAPI::class)->group(function () {
    Route::get('home', 'home');
    Route::get('payment_methods', 'payment_methods');
    Route::get('mosques', 'mosques');
    Route::get('settings', 'settings');
    Route::get('offers', 'offers');
    Route::post('contact', 'contact');
    Route::get('settings', 'settings')->name('settings');
    Route::get('terms_and_conditions', 'terms_and_conditions')->name('terms_and_conditions');
    Route::get('faqs', 'faqs')->name('faqs');
    Route::get('about', 'about')->name('about');
    Route::get('privacy', 'privacy')->name('privacy');


});

Route::controller(StoreController::class)->group(function () {
    Route::get('products', 'products');
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::controller(ProfileAPI::class)->group(function () {
        Route::get('profile', 'profile');
        Route::post('account_update', 'update_account');

        Route::get('addresses', 'addresses');
        Route::post('addresses', 'add_address');
        Route::post('update_address', 'update_address');
        Route::post('delete_address', 'delete_address');
        Route::post('deleteaccount', 'deleteaccount');
    });


    Route::controller(OrderController::class)->group(function () {
        Route::get('cart_count', 'cart_count');
        Route::get('cart', 'cart');
        Route::post('add_to_cart', 'add_to_cart');
        Route::post('checkCoupon', 'checkCoupon');
        Route::post('favorite_order', 'favorite_order');
        Route::post('cancel_order', 'cancel_order');
        Route::get('orders', 'orders');
        Route::post('make_order', 'make_order');
    });

});

Route::any('{id}/{id2?}', function ($id) {
    // return (request()->is('api') || request()->is('api/*'));
    $codeIs = [
        'status' => true,
        'errNum' => 'CHAT15',
        'msg' => 'الصفحة المطلوبة غير متوفرة',
    ];
    return $codeIs;
});
