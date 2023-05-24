<?php

namespace App\Providers;

use Spatie\Flash\Flash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        if(Schema::hasTable('settings')){
            $settings = \App\Models\Setting::count();
            if($settings==0)
                \App\Models\Setting::create([
                    'website_name'=>"اسم الموقع هنا",
                    'website_bio'=>"نبذة عن الموقع",
                    'main_color'=>"#0194fe",
                    'hover_color'=>"#0194fe",
                ]);
            $settings = \App\Models\Setting::first();
            View::share('settings', $settings);
        }
        Flash::levels([
            'success' => 'alert-success',
            'warning' => 'alert-warning',
            'error' => 'alert-error',
        ]);
    }
}
