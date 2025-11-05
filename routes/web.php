<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\App;


Route::get('/assets/plugins/commoncss.php', function () {
    // Make sure to set CSS header
    header('Content-Type: text/css');

    // Include your PHP file manually
    include public_path('assets/plugins/commoncss.php');
    exit();
});





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
if (!function_exists('registerLocalizedRoutes')) {
    function registerLocalizedRoutes()
    {
        localizedRoute('/', [FrontendController::class, 'index'], 'home');
        localizedRoute('/login', [AuthController::class, 'index'], 'login');
        localizedRoute('/registration', [AuthController::class, 'registration'], 'register');
        localizedRoute('/weblogin', [AuthController::class, 'weblogin'], 'weblogin');

        Route::middleware(['auth:sanctum'])->group(function () {
            localizedRoute('/admin/dashboard', [DashboardController::class, 'index'], 'dashboard.index');
            localizedRoute('/admin/language-list', [LanguageController::class, 'language_list'], 'language-list');
            localizedRoute('/admin/language-data', [LanguageController::class, 'language_data'], 'language-data');

            localizedRoute('/admin/add_language_data', [LanguageController::class, 'add_language_data'], 'add_language_data');
        });
    }
}

$urlStyle = config('localization.url_style', 'query');

if ($urlStyle === 'suffix') {
    Route::pattern('locale', implode('|', config('localization.supported_locales')));

    registerLocalizedRoutes();

    Route::get('/', function () {
        return redirect('/' . config('localization.fallback_locale', 'en'));
    });
} else {
    registerLocalizedRoutes();
}

//Backend

// Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::get('/admin', [AuthController::class, 'index'])->name('login');









Route::get('/{slug}', [ProfileController::class, 'index']);
