<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MediaFileController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CssController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\PagesController;
use App\Http\Controllers\Vendor\ProductsController;
use App\Http\Controllers\Vendor\ProfileController as VendorProfileController;
use App\Http\Controllers\Vendor\ReportController;
use App\Http\Controllers\Vendor\SettingsController as VendorSettingsController;
use App\Http\Controllers\Vendor\StaffController;





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


            localizedRoute('/delete-item/{id}/{table}', [AdminAuthController::class, 'item_delete'], 'item_delete');

            // Vendor Area Start

            localizedRoute('/vendor/dashboard', [VendorDashboardController::class, 'index'], 'vendor_dashboard.index');
            localizedRoute('/vendor/whatsapp-order', [VendorDashboardController::class, 'whatsapp_order'], 'whatsapp_order.index');
            localizedRoute('/vendor/subscriptions', [VendorDashboardController::class, 'subscriptions'], 'subscriptions.index');
            localizedRoute('/vendor/subscription-list', [VendorDashboardController::class, 'subscription_list'], 'subscription_list.index');

            localizedRoute('/vendor/order-list', [OrderController::class, 'order_list'], 'order_list.index');
            localizedRoute('/vendor/all-orders-list', [OrderController::class, 'all_order_list'], 'all_order_list.index');
            localizedRoute('/vendor/order-details/{order_id}', [OrderController::class, 'order_details'], 'order_details.index');

            localizedRoute('/vendor/settings', [VendorSettingsController::class, 'index'], 'settings.index');
            localizedRoute('/vendor/settings/general', [VendorSettingsController::class, 'general'], 'settings_general.index');
            localizedRoute('/vendor/settings/email-settings', [VendorSettingsController::class, 'email_settings'], 'email_settings.index');
            localizedRoute('/vendor/settings/apperence', [VendorSettingsController::class, 'apperence'], 'apperence.index');
            localizedRoute('/vendor/settings/available-days', [VendorSettingsController::class, 'available_days'], 'available_days.index');
            localizedRoute('/vendor/settings/payment-settings', [VendorSettingsController::class, 'payment_settings'], 'payment_settings.index');

            localizedRoute('/vendor/settings/slider', [VendorSettingsController::class, 'slider'], 'slider.index');
            localizedRoute('/vendor/settings/add_slider', [VendorSettingsController::class, 'add_slider'], 'add_slider.index');

            localizedRoute('/vendor/settings/qrcode', [VendorSettingsController::class, 'qrcode'], 'qrcode.index');
            localizedRoute('/vendor/settings/order-types', [VendorSettingsController::class, 'order_types'], 'order_types.index');
            localizedRoute('/vendor/settings/order-type-settings/cod', [VendorSettingsController::class, 'order_type_settings'], 'order_type_settings.index');
            localizedRoute('/vendor/settings/order-configuration', [VendorSettingsController::class, 'order_config'], 'order_config.index');
            localizedRoute('/vendor/settings/item-configuration', [VendorSettingsController::class, 'item_config'], 'item_config.index');
            localizedRoute('/vendor/settings/tax-configuration', [VendorSettingsController::class, 'tax_config'], 'tax_config.index');
            localizedRoute('/vendor/settings/add_new_tax', [VendorSettingsController::class, 'add_new_tax'], 'add_new_tax.index');

            localizedRoute('/vendor/products', [ProductsController::class, 'index'], 'products.index');
            localizedRoute('/vendor/products/create-product', [ProductsController::class, 'create_product'], 'create_product.index');
            localizedRoute('/vendor/products/get_subcategory/{cat_id}', [ProductsController::class, 'get_subcategory'], 'get_subcategory.index');
            localizedRoute('/vendor/products/create_product_variants/{ln}', [ProductsController::class, 'create_product_variants'], 'create_product_variants.index');
            localizedRoute('/vendor/products/add_product', [ProductsController::class, 'add_product'], 'add_product.index');
            localizedRoute('/vendor/products/edit-product/{id}', [ProductsController::class, 'edit_product'], 'edit_product.index');

            localizedRoute('/vendor/products/add_new_extras', [ProductsController::class, 'add_new_extras'], 'add_new_extras.index');
            localizedRoute('/vendor/products/add_library_extras', [ProductsController::class, 'add_library_extras'], 'add_library_extras.index');
            localizedRoute('/vendor/products/edit_assing_extra', [ProductsController::class, 'edit_assing_extra'], 'edit_assing_extra.index');
            localizedRoute('/vendor/products/add_item_addons', [ProductsController::class, 'add_item_addons'], 'add_item_addons.index');


            localizedRoute('/vendor/products/addons/{id}', [ProductsController::class, 'addons'], 'addon.index');
            localizedRoute('/vendor/products/categories', [ProductsController::class, 'category_list'], 'categories.index');
            localizedRoute('/vendor/products/add_category', [ProductsController::class, 'add_category'], 'add_category.index');
            localizedRoute('/vendor/products/subcategories', [ProductsController::class, 'subcategory_list'], 'subcategories.index');
            localizedRoute('/vendor/products/add_subcategory', [ProductsController::class, 'add_subcategory'], 'add_subcategory.index');
            localizedRoute('/vendor/products/allergens', [ProductsController::class, 'allergen_list'], 'allergens.index');
            localizedRoute('/vendor/products/add-allergen', [ProductsController::class, 'add_allergen'], 'add_allergen.index');
            localizedRoute('/vendor/products/addons-library', [ProductsController::class, 'addons_library'], 'addons_library.index');
            localizedRoute('/vendor/products/add-addons', [ProductsController::class, 'add_addon'], 'add_addon.index');

            localizedRoute('/vendor/customer-list', [StaffController::class, 'customer_list'], 'customer_list.index');
            localizedRoute('/vendor/add-customer', [StaffController::class, 'add_customer'], 'add_customer.index');

            localizedRoute('/vendor/reports/item-reports', [ReportController::class, 'item_reports'], 'item_reports.index');
            localizedRoute('/vendor/reports/order-reports', [ReportController::class, 'order_reports'], 'order_reports.index');

            localizedRoute('/vendor/cookies', [PagesController::class, 'cookies'], 'cookies.index');
            localizedRoute('/vendor/pages/add_page', [PagesController::class, 'add_page'], 'add_page.index');
            localizedRoute('/vendor/terms', [PagesController::class, 'terms'], 'terms.index');


            localizedRoute('/vendor/profile', [VendorProfileController::class, 'index'], 'profile.index');
            localizedRoute('/vendor/profile/account', [VendorProfileController::class, 'account'], 'account.index');
            localizedRoute('/vendor/profile/password', [VendorProfileController::class, 'password'], 'password.index');
            localizedRoute('/vendor/profile/onboarding', [VendorProfileController::class, 'onboarding'], 'onboarding.index');
        });
    }
}

$urlStyle = config('localization.url_style', 'query');
if ($urlStyle === 'suffix') {
    Route::pattern('locale', implode('|', config('localization.supported_locales')));

    Route::get('/', function () {
        return redirect('/' . config('localization.fallback_locale', 'en'));
    });
}

// Catch-all Profile Route (Must be last)
Route::get('/{slug}', [ProfileController::class, 'index'])->name('profile.show');
