<?php

use App\Models\User;
use App\Models\Order;
use App\Helpers\MainHelper;
use App\Http\Controllers\CouponController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Notifications\GeneralNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ChatController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\OfferController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\SportController;
use App\Http\Controllers\Dashboard\VideoController;
use App\Http\Controllers\Dashboard\MosqueController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\NotificationsController;

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'admin.index')->name('dashboard');
    // Route::view('/', 'admin.index')->name('home');
});


Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('', [AdminController::class,'index'])->name('index');
    Route::get('printOrder/{number}', function ($number) {
        $order  = Order::where('number', $number)->first();
        return view('admin.orders.print', compact('order'));
    })->name('printOrder');


    Route::resource('sports', SportController::class);

    Route::resource('videos', VideoController::class);
    Route::post('videos/updateStatus/{video}', [VideoController::class,'updateStatus'])->name('videos.updateStatus');

    Route::resource('coupons', CouponController::class);
    Route::resource('chats', ChatController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('mosques', MosqueController::class);
    Route::post('chats/updateStatus/{chat}', [ChatController::class,'updateStatus'])->name('chats.updateStatus');
    Route::resource('products', ProductController::class);
    Route::resource('files', FileController::class);
    Route::post('contacts/resolve', [ContactController::class,'resolve'])
    ->can('resolve', \App\Models\Contact::class)->name('contacts.resolve');
    Route::resource('contacts', ContactController::class);
    Route::post('users/sendNotify', [UserController::class,'sendNotify'])->name('users.sendNotify');
    Route::get('best_users', [UserController::class,'best'])->name('users.best');
    Route::post('best_users', [UserController::class,'post_best'])->name('users.post_best');
    Route::post('delete_best_users', [UserController::class,'delete_best'])->name('users.delete_best_users');
    Route::resource('users', UserController::class);

    Route::resource('companies', CompanyController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'update', 'show', 'destroy']);
    Route::resource('redirections', RedirectionController::class);
    Route::get('traffics', [TrafficsController::class,'index'])->name('traffics.index');
    Route::get('traffics/{traffic}/logs', [TrafficsController::class,'logs'])->name('traffics.logs');
    Route::get('error-reports', [TrafficsController::class,'error_reports'])->name('traffics.error-reports');
    Route::get('error-reports/{report}', [TrafficsController::class,'error_report'])->name('traffics.error-report');
    Route::post('footer-links/order', [FooterLinkController::class,'order'])->name('footer-links.order');
    Route::resource('footer-links', FooterLinkController::class);
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class,'index'])->name('index');
        Route::put('/{settings}/update', [SettingController::class,'update'])->name('update');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class,'index'])->name('index');
        Route::get('/edit', [ProfileController::class,'edit'])->name('edit');
        Route::put('/update', [ProfileController::class,'update'])->name('update');
        Route::put('/update-password', [ProfileController::class,'update_password'])->name('update-password');
        Route::put('/update-email', [ProfileController::class,'update_email'])->name('update-email');
    });

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationsController::class,'index'])->name('index');
        Route::get('/ajax', [NotificationsController::class,'notifications_ajax'])->name('ajax');
        Route::post('/see', [NotificationsController::class,'notifications_see'])->name('see');
    });
});

Route::post('/uploadToServer', [VideoController::class,'uploadToServer'])->name('uploadToServer');

Route::get('robots.txt', [HelperController::class,'robots']);
Route::get('manifest.json', [HelperController::class,'manifest'])->name('manifest');
Route::get('sitemap.xml', [SiteMapController::class,'sitemap']);
Route::get('sitemaps/links', [SiteMapController::class, 'custom_links']);
Route::get('sitemaps/{name}/{page}/sitemap.xml', [SiteMapController::class,'viewer']);




Route::view('contact', 'front.pages.contact')->name('contact');
