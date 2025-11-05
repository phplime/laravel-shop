<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
<<<<<<< Updated upstream
use App\Http\Controllers\vendor\OrderController;
use App\Http\Controllers\vendor\SettingsController;
use App\Http\Controllers\vendor\VendorController;
=======
use Illuminate\Support\Facades\App;

>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
function registerLocalizedRoutes()
{
    Route::get('/{locale?}', [FrontendController::class, 'index'])->name('home');
    Route::get('/login/{locale?}', [AuthController::class, 'index'])->name('login');
    Route::get('/registration/{locale?}', [AuthController::class, 'registration'])->name('register');
    Route::post('/weblogin/{locale?}', [AuthController::class, 'weblogin'])->name('weblogin');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/admin/dashboard/{locale?}', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/admin/language-list/{locale?}', [LanguageController::class, 'language_list'])->name('language-list');
        Route::get('/admin/language-data/{locale?}', [LanguageController::class, 'language_data'])->name('language-data');

        // Vendor Area Start

        Route::get('/vendor/dashboard/{locale?}', [VendorController::class, 'index'])->name('vendor_dashboard.index');
        Route::get('/vendor/order-list/{locale?}', [OrderController::class, 'order_list'])->name('order_list.index');
        Route::get('/vendor/all-orders-list/{locale?}', [OrderController::class, 'all_order_list'])->name('all_order_list.index');
        Route::get('/vendor/order-details/{order_id}/{locale?}', [OrderController::class, 'order_details'])->name('order_details.index');

        Route::get('/vendor/settings/{locale?}', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('/vendor/settings/general/{locale?}', [SettingsController::class, 'general'])->name('settings_general.index');
        Route::get('/vendor/settings/email-settings/{locale?}', [SettingsController::class, 'email_settings'])->name('email_settings.index');
        Route::get('/vendor/settings/apperence/{locale?}', [SettingsController::class, 'apperence'])->name('apperence.index');
        Route::get('/vendor/settings/available-days/{locale?}', [SettingsController::class, 'available_days'])->name('available_days.index');
        Route::get('/vendor/settings/payment-settings/{locale?}', [SettingsController::class, 'payment_settings'])->name('payment_settings.index');
        Route::get('/vendor/settings/slider/{locale?}', [SettingsController::class, 'slider'])->name('slider.index');
        Route::get('/vendor/settings/qrcode/{locale?}', [SettingsController::class, 'qrcode'])->name('qrcode.index');
        Route::get('/vendor/settings/order_types/{locale?}', [SettingsController::class, 'order_types'])->name('order_types.index');
        Route::get('/vendor/settings/order_type_settings/cod/{locale?}', [SettingsController::class, 'order_type_settings'])->name('order_type_settings.index');
    });
}

$urlStyle = config('localization.url_style', 'query'); // suffix | query

switch ($urlStyle) {
    case 'suffix':
        Route::pattern('locale', implode('|', config('localization.supported_locales')));

        registerLocalizedRoutes();

        // Redirect root to default locale
        Route::get('/', function () {
            return redirect('/' . config('localization.fallback_locale', 'en'));
        });
        break;

    case 'query':
    default:
        registerLocalizedRoutes();
   break;
=======
        Route::middleware(['auth:sanctum'])->group(function () {
            localizedRoute('/admin/dashboard', [DashboardController::class, 'index'], 'dashboard.index');
            localizedRoute('/admin/language-list', [LanguageController::class, 'language_list'], 'language-list');
            localizedRoute('/admin/language-data', [LanguageController::class, 'language_data'], 'language-data');
            localizedRoute('/admin/add_language_data', [LanguageController::class, 'add_language_data'], 'add_language_data');
        });
    }
>>>>>>> Stashed changes
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
