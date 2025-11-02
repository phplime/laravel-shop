<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PackageController;

Route::get('/assets/plugins/commoncss.php', function () {
    // Make sure to set CSS header
    header('Content-Type: text/css');

    // Include your PHP file manually
    include public_path('assets/plugins/commoncss.php');
    exit();
});


Route::get('/', [FrontendController::class, 'index']);


/* ======================================
        Profile Controller
======================================== */
// Route::controller(ProfileController::class)->group(function () {
//     Route::get('/{slug}', [ProfileController::class, 'home'])->name('home.index');
//     Route::get('/menu/{slug}', [ProfileController::class, 'menu'])->name('menu.index');
//     Route::get('/all_items/{slug}', [ProfileController::class, 'all_items'])->name('all_items.index');
//     Route::get('/special/items/{slug}', [ProfileController::class, 'special_items'])->name('special.index');
//     Route::get('/my_profile/{slug}', [ProfileController::class, 'index'])->name('profile.index');
//     Route::get('/my_orders/{slug}', [ProfileController::class, 'my_order'])->name('my_orders.index');
//     Route::get('/view-order/{order_id}/{slug}', [ProfileController::class, 'view_order'])->name('view_order.index');
//     Route::get('/checkout/{slug}', [ProfileController::class, 'checkout'])->name('checkout.index');
// });


$urlStyle = config('localization.url_style', 'query');

// if ($urlStyle === 'suffix') {
//     Route::pattern('locale', implode('|', config('localization.supported_locales')));

//     Route::get('/{locale}', [FrontendController::class, 'index'])->name('home');
//     Route::get('/login/{locale}', [AuthController::class, 'index'])->name('login');
//     Route::get('/registration/{locale}', [AuthController::class, 'registration'])->name('register');
//     Route::get('/admin/{locale}', [AuthController::class, 'admin'])->name('admin');

//     Route::get('/', function () {
//         return redirect('/' . config('localization.fallback_locale', 'en'));
//     });
// } else {
//     // Query style routes: /login?lang=en
//     Route::get('/', [FrontendController::class, 'index'])->name('home');
//     Route::get('/login', [AuthController::class, 'index'])->name('login');
//     Route::get('/registration', [AuthController::class, 'registration'])->name('register');
//     Route::get('/admin', [AuthController::class, 'index'])->name('admin');
// }



//Backend

Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::get('/admin', [AuthController::class, 'index'])->name('login');

Route::post('weblogin', [AuthController::class, 'weblogin'])->name('weblogin');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/admin/user_list', [DashboardController::class, 'user_list'])->name('user_list.index');
    Route::get('/admin/user_details/{username}', [DashboardController::class, 'user_details'])->name('user_details.index');
    Route::get('/subscription-invoice/{id}', [DashboardController::class, 'subscription_invoice'])->name('subscription_invoice.index');
    Route::get('/admin/language', [DashboardController::class, 'language_list'])->name('language_list.index');
    Route::get('/admin/language_data', [DashboardController::class, 'language_data'])->name('language_data.index');
    Route::post('add/language_data', [DashboardController::class, 'add_language_data'])->name('language_data.store');

    Route::get('/admin/package', [PackageController::class, 'index'])->name('package.index');
    Route::get('/admin/package/create', [PackageController::class, 'package_create'])->name('package.create');
    Route::get('/admin/feature', [PackageController::class, 'feature'])->name('feature.index');
    Route::get('/admin/feature/create', [PackageController::class, 'feature_create'])->name('feature.create');
});





// Route::get('/{slug}', [ProfileController::class, 'index']);
