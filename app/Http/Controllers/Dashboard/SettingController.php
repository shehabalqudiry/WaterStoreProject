<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    public function index()
    {
        $settings = Setting::firstOrCreate();
        return view('admin.settings.index',compact('settings'));
    }

    public function update(Request $request, Setting $settings)
    {
        \App\Models\Setting::query()->update([
            'website_name'=>$request->website_name,
            'address'=>$request->address,
            'website_bio'=>$request->website_bio,
            'contact_email'=>$request->contact_email,
            'delivery_price'=>$request->delivery_price,
            'min_order_price'=>$request->min_order_price,
            'free_delivery_price'=>$request->free_delivery_price,
            'main_color'=>$request->main_color,
            'hover_color'=>$request->hover_color,
            'phone'=>$request->phone,
            'phone2'=>$request->phone2,
            'whatsapp_phone'=>$request->whatsapp_phone,
            'facebook_link'=>$request->facebook_link,
            'twitter_link'=>$request->twitter_link,
            'instagram_link'=>$request->instagram_link,
            'youtube_link'=>$request->youtube_link,
            'telegram_link'=>$request->telegram_link,
            'whatsapp_link'=>$request->whatsapp_link,
            'tiktok_link'=>$request->tiktok_link,
            'nafezly_link'=>$request->nafezly_link,
            'linkedin_link'=>$request->linkedin_link,
            'github_link'=>$request->github_link,
            'google_play_link'=>$request->google_play_link,
            'app_store_link'=>$request->app_store_link,
            'another_link3'=>$request->another_link3,
            'contact_page'=>$request->contact_page,
            'header_code'=>$request->header_code,
            'footer_code'=>$request->footer_code,
            'robots_txt'=>$request->robots_txt,
        ]);

        if($request->hasFile('website_logo')){

            \App\Models\Setting::query()->update(['website_logo'=>uploadImage('settings', $request->website_logo)]);
        }
        if($request->hasFile('website_wide_logo')){

            \App\Models\Setting::query()->update(['website_wide_logo'=>uploadImage('settings', $request->website_wide_logo)]);
        }
        if($request->hasFile('website_icon')){

            \App\Models\Setting::query()->update(['website_icon'=>uploadImage('settings', $request->website_icon)]);
        }
        if($request->hasFile('website_cover')){
            \App\Models\Setting::query()->update(['website_cover'=>uploadImage('settings', $request->website_cover)]);
        }
        flash()->success('تم تحديث الإعدادات بنجاح','عملية ناجحة');
        return redirect()->back();

    }

}
