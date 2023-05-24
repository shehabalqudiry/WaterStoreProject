<?php

use App\Http\Controllers\LangController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function () { //...
        Route::name('frontend.')->group(function () {
            // Route::get('/', [UserController::class, 'index']);
            Route::view('/', 'frontend.index')->name('index');
            // Route::any('{id}/{id2?}', function () {
            //     // Route::get('/', [UserController::class, 'index']);
            //     return view('errors.404');
            // });
        });
    }
);
