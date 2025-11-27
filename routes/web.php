<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MediaFileController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;

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


            //post
            localizedRoute('/admin/add_language_data', [LanguageController::class, 'add_language_data'], 'add_language_data');
            localizedRoute('/admin/add_new_language', [LanguageController::class, 'add_new_language'], 'add_new_language');
            localizedRoute('/admin/add_all_language_data/{slug}', [LanguageController::class, 'add_all_language_data'], 'add_all_language_data');


            //package
            localizedRoute('/admin/package_list', [PackageController::class, 'index'], 'package_list');
            localizedRoute('/admin/feature-list', [PackageController::class, 'feature_list'], 'feature_list');
            localizedRoute('/admin/add_new_feature', [PackageController::class, 'add_new_feature'], 'add_new_feature');


            localizedRoute('/admin/create-package', [PackageController::class, 'create_package'], 'create-package');

            localizedRoute('/admin/edit-package/{slug}', [PackageController::class, 'edit_package'], 'edit-package');


            localizedRoute('/admin/savePackage', [PackageController::class, 'savePackage'], 'savePackage');



            localizedRoute('/admin/module', [ModuleController::class, 'index'], 'module');
            localizedRoute('/admin/module/add_order_types', [ModuleController::class, 'add_order_types'], 'add_order_types');

            localizedRoute('/admin/module/add_module_features', [ModuleController::class, 'add_module_features'], 'add_module_features');

            localizedRoute('/admin/module/add_new_module', [ModuleController::class, 'add_new_module'], 'add_new_module');


            localizedRoute('/media/show', [MediaFileController::class, 'index'], 'show');
            localizedRoute('/media/save', [MediaFileController::class, 'upload'], 'save');
            localizedRoute('/media/delete', [MediaFileController::class, 'delete'], 'delete');
            localizedRoute('/media/select', [MediaFileController::class, 'select'], 'select');



            localizedRoute('/admin/settings', [SettingsController::class, 'index'], 'settings');

            localizedRoute('/admin/settings/preferences', [SettingsController::class, 'preferences'], 'preferences');

            localizedRoute('/admin/settings/add_settings', [SettingsController::class, 'add_settings'], 'add_settings');
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
