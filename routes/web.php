<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CssController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaFileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;




Route::get('dynamic/commoncss', [CssController::class, 'commoncss']);

// Public Routes
localizedRoute('/', [FrontendController::class, 'index'], 'home');


localizedRoute('/login', [LoginController::class, 'index'], 'tyro-login.login', ['get']);
localizedRoute('/login', [LoginController::class, 'login'], 'tyro-login.login.submit', ['post']);

localizedRoute('/register', [RegisterController::class, 'index'], 'tyro-login.register', ['get']);
localizedRoute('/register', [RegisterController::class, 'register'], 'tyro-login.register.submit', ['post']);


localizedRoute('/registration_mail', [RegisterController::class, 'registration_mail'], 'registration_mail');



localizedRoute('/payment-method/{slug}/{package_slug}', [PaymentController::class, 'index'], 'payment.index');
localizedRoute('/payment/process/{slug}/{package_slug}/{method}', [PaymentController::class, 'process'], 'payment.process');

localizedRoute('/payment/failed', [PaymentController::class, 'failed'], 'payment.failed');
localizedRoute('payment/success/{slug}', [PaymentController::class, 'success'], 'payment.success');




localizedRoute('/weblogin', [AuthController::class, 'weblogin'], 'weblogin');


// Route::prefix('payment')->name('payment.')->group(function () {
//     localizedRoute('/payment-gateway/{slug}/{uid}', [PaymentController::class, 'index'], 'payment.index');
// });



// Authenticated Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    localizedRoute('/dashboard', [DashboardController::class, 'index'], 'dashboard.index');
    localizedRoute('subscriber-list', [DashboardController::class, 'subscriber_list'], 'subscriber-list');
    localizedRoute('/user_details/{username}', [DashboardController::class, 'user_details'], 'user_details');
    Route::post('dashboard/update_user_access', [DashboardController::class, 'update_user_access'])->name('update_user_access');

    // Language Routes
    Route::prefix('language')->name('language.')->group(function () {
        localizedRoute('/language-list', [LanguageController::class, 'language_list'], 'language-list');
        localizedRoute('/language-data', [LanguageController::class, 'language_data'], 'language-data');
        localizedRoute('/add_language_data', [LanguageController::class, 'add_language_data'], 'add_language_data');
        localizedRoute('/add_new_language', [LanguageController::class, 'add_new_language'], 'add_new_language');
        localizedRoute('/add_all_language_data/{slug}', [LanguageController::class, 'add_all_language_data'], 'add_all_language_data');
    });

    // Package Routes
    Route::prefix('package')->name('package.')->group(function () {
        localizedRoute('/package_list', [PackageController::class, 'index'], 'package_list');
        localizedRoute('/feature-list', [PackageController::class, 'feature_list'], 'feature_list');
        localizedRoute('/add_new_feature', [PackageController::class, 'add_new_feature'], 'add_new_feature');
        localizedRoute('/create-package', [PackageController::class, 'create_package'], 'create-package');
        localizedRoute('/edit-package/{slug}', [PackageController::class, 'edit_package'], 'edit-package');
        localizedRoute('/savePackage', [PackageController::class, 'savePackage'], 'savePackage');
    });

    // Module Routes
    Route::prefix('module')->name('module.')->group(function () {
        localizedRoute('/module', [ModuleController::class, 'index'], 'module');
        localizedRoute('/module/add_order_types', [ModuleController::class, 'add_order_types'], 'add_order_types');
        localizedRoute('/module/add_module_features', [ModuleController::class, 'add_module_features'], 'add_module_features');
        localizedRoute('/module/add_new_module', [ModuleController::class, 'add_new_module'], 'add_new_module');
    });

    // Media Routes
    Route::prefix('media')->name('media.')->group(function () {
        localizedRoute('/media/show', [MediaFileController::class, 'index'], 'show');
        localizedRoute('/media/save', [MediaFileController::class, 'upload'], 'save');
        localizedRoute('/media/delete', [MediaFileController::class, 'delete'], 'delete');
        localizedRoute('/media/select', [MediaFileController::class, 'select'], 'select');
    });

    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        localizedRoute('/', [SettingsController::class, 'index'], 'settings');
        localizedRoute('/preferences', [SettingsController::class, 'preferences'], 'preferences');
        localizedRoute('/add_settings', [SettingsController::class, 'add_settings'], 'add_settings');
        localizedRoute('/setting_status/{type}/{value}', [SettingsController::class, 'setting_status'], 'setting_status');
        localizedRoute('/email-settings', [SettingsController::class, 'email_settings'], 'email-settings');
        localizedRoute('/add_email_settings', [SettingsController::class, 'add_email_settings'], 'add_email_settings');
        localizedRoute('/add_email_template', [SettingsController::class, 'add_email_template'], 'add_email_template');
        localizedRoute('/testmail', [SettingsController::class, 'testmail'], 'testmail');

        localizedRoute('/payment-settings', [SettingsController::class, 'payment_settings'], 'admin.payment_settings');
    });

    Route::prefix('settings')->name('settings.payment.')->group(function () {

        localizedRoute('/payment-settings', [SettingsController::class, 'payment_settings'], 'admin.payment_settings');

        localizedRoute('/add_new_payment', [SettingsController::class, 'add_new_payment'], 'admin.payment.add_new_payment');
    });
});

Route::prefix('public')->name('public.')->group(function () {
    localizedRoute('/add_payment_config', [CommonController::class, 'add_payment_config'], 'add_payment_config');
});

// Locale Pattern for Suffix Style
$urlStyle = config('localization.url_style', 'query');
if ($urlStyle === 'suffix') {
    Route::pattern('locale', implode('|', config('localization.supported_locales')));

    Route::get('/', function () {
        return redirect('/' . config('localization.fallback_locale', 'en'));
    });
}

// Catch-all Profile Route (Must be last)
Route::get('/{slug}', [ProfileController::class, 'index'])->name('profile.show');
