<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CssController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaFileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\PagesController;
use App\Http\Controllers\Vendor\ProductsController;
use App\Http\Controllers\Vendor\ProfileController as VendorProfileController;
use App\Http\Controllers\Vendor\ReportController;
use App\Http\Controllers\Vendor\SettingsController as VendorSettingsController;
use App\Http\Controllers\Vendor\StaffController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('dynamic/commoncss', [CssController::class, 'commoncss']);
Route::get('lang/{code}', [CommonController::class, 'switch_language'])->name('switch_language');

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

Route::prefix('public')->name('public.')->group(function () {
    localizedRoute('/add_payment_config', [CommonController::class, 'add_payment_config'], 'add_payment_config');
});

localizedRoute('/dashboard-redirect', [CommonController::class, 'dashboard_redirect'], 'dashboard.redirect');


//delete items
localizedRoute('/delete-item/{id}/{table}', [CommonController::class, 'item_delete'], 'item_delete');

/* ======================================
        Admin Routes
======================================== */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    localizedRoute('/dashboard', [DashboardController::class, 'index'], 'dashboard.index');
    localizedRoute('/subscriber-list', [DashboardController::class, 'subscriber_list'], 'subscriber-list');
    localizedRoute('/user_details/{username}', [DashboardController::class, 'user_details'], 'user_details');
    Route::post('/dashboard/update_user_access', [DashboardController::class, 'update_user_access'])->name('update_user_access');

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
        localizedRoute('/', [ModuleController::class, 'index'], 'module');
        localizedRoute('/add_order_types', [ModuleController::class, 'add_order_types'], 'add_order_types');
        localizedRoute('/add_module_features', [ModuleController::class, 'add_module_features'], 'add_module_features');
        localizedRoute('/add_new_module', [ModuleController::class, 'add_new_module'], 'add_new_module');
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

        localizedRoute('/payment-settings', [SettingsController::class, 'payment_settings'], 'payment_settings');
        localizedRoute('/add_new_payment', [SettingsController::class, 'add_new_payment'], 'payment.add_new_payment');
    });
});

/* ======================================
        Vendor Routes
======================================== */
Route::middleware(['auth', 'vendor'])->prefix('vendor')->name('vendor.')->group(function () {

    localizedRoute('/dashboard', [VendorDashboardController::class, 'index'], 'dashboard.index');
    localizedRoute('/whatsapp-order', [VendorDashboardController::class, 'whatsapp_order'], 'whatsapp_order.index');
    localizedRoute('/subscriptions', [VendorDashboardController::class, 'subscriptions'], 'subscriptions.index');
    localizedRoute('/subscription-list', [VendorDashboardController::class, 'subscription_list'], 'subscription_list.index');

    localizedRoute('/order-list', [OrderController::class, 'order_list'], 'order_list.index');
    localizedRoute('/all-orders-list', [OrderController::class, 'all_order_list'], 'all_order_list.index');
    localizedRoute('/order-details/{order_id}', [OrderController::class, 'order_details'], 'order_details.index');

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        localizedRoute('/', [VendorSettingsController::class, 'index'], 'index');
        localizedRoute('/general', [VendorSettingsController::class, 'general'], 'general.index');
        localizedRoute('/add_settings', [VendorSettingsController::class, 'add_settings'], 'add_settings');
        localizedRoute('/add_general_settings', [VendorSettingsController::class, 'add_general_settings'], 'add_general_settings');
        localizedRoute('/email-settings', [VendorSettingsController::class, 'email_settings'], 'email_settings.index');
        localizedRoute('/add_email_settings', [VendorSettingsController::class, 'add_email_settings'], 'add_email_settings');
        localizedRoute('/apperence', [VendorSettingsController::class, 'apperence'], 'apperence.index');
        localizedRoute('/available-days', [VendorSettingsController::class, 'available_days'], 'available_days.index');
        localizedRoute('/payment-settings', [VendorSettingsController::class, 'payment_settings'], 'payment_settings.index');
        localizedRoute('/slider', [VendorSettingsController::class, 'slider'], 'slider.index');
        localizedRoute('/add_slider', [VendorSettingsController::class, 'add_slider'], 'add_slider.index');
        localizedRoute('/qrcode', [VendorSettingsController::class, 'qrcode'], 'qrcode.index');
        localizedRoute('/order-types', [VendorSettingsController::class, 'order_types'], 'order_types.index');
        localizedRoute('/order-type-settings/cod', [VendorSettingsController::class, 'order_type_settings'], 'order_type_settings.index');
        localizedRoute('/order-configuration', [VendorSettingsController::class, 'order_config'], 'order_config.index');
        localizedRoute('/item-configuration', [VendorSettingsController::class, 'item_config'], 'item_config.index');
        localizedRoute('/tax-configuration', [VendorSettingsController::class, 'tax_config'], 'tax_config.index');
        localizedRoute('/add_new_tax', [VendorSettingsController::class, 'add_new_tax'], 'add_new_tax.index');
    });

    // Products
    Route::prefix('products')->name('products.')->group(function () {
        localizedRoute('/', [ProductsController::class, 'index'], 'index');
        localizedRoute('/create-product', [ProductsController::class, 'create_product'], 'create_product.index');
        localizedRoute('/get_subcategory/{cat_id}', [ProductsController::class, 'get_subcategory'], 'get_subcategory.index');
        localizedRoute('/create_product_variants/{ln}', [ProductsController::class, 'create_product_variants'], 'create_product_variants.index');
        localizedRoute('/add_product', [ProductsController::class, 'add_product'], 'add_product.index');
        localizedRoute('/edit-product/{id}', [ProductsController::class, 'edit_product'], 'edit_product.index');
        localizedRoute('/add_new_extras', [ProductsController::class, 'add_new_extras'], 'add_new_extras.index');
        localizedRoute('/add_library_extras', [ProductsController::class, 'add_library_extras'], 'add_library_extras.index');
        localizedRoute('/edit_assing_extra', [ProductsController::class, 'edit_assing_extra'], 'edit_assing_extra.index');
        localizedRoute('/add_item_addons', [ProductsController::class, 'add_item_addons'], 'add_item_addons.index');
        localizedRoute('/addons/{id}', [ProductsController::class, 'addons'], 'addon.index');
        localizedRoute('/categories', [ProductsController::class, 'category_list'], 'categories.index');
        localizedRoute('/add_category', [ProductsController::class, 'add_category'], 'add_category.index');
        localizedRoute('/subcategories', [ProductsController::class, 'subcategory_list'], 'subcategories.index');
        localizedRoute('/add_subcategory', [ProductsController::class, 'add_subcategory'], 'add_subcategory.index');
        localizedRoute('/allergens', [ProductsController::class, 'allergen_list'], 'allergens.index');
        localizedRoute('/add-allergen', [ProductsController::class, 'add_allergen'], 'add_allergen.index');
        localizedRoute('/addons-library', [ProductsController::class, 'addons_library'], 'addons_library.index');
        localizedRoute('/add-addons', [ProductsController::class, 'add_addon'], 'add_addon.index');
        localizedRoute('/show/{id}', [ProductsController::class, 'show'], 'add_addon.show');
    });

    localizedRoute('/customer-list', [StaffController::class, 'customer_list'], 'customer_list.index');
    localizedRoute('/add-customer', [StaffController::class, 'add_customer'], 'add_customer.index');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        localizedRoute('/item-reports', [ReportController::class, 'item_reports'], 'item_reports.index');
        localizedRoute('/order-reports', [ReportController::class, 'order_reports'], 'order_reports.index');
    });

    localizedRoute('/cookies', [PagesController::class, 'cookies'], 'cookies.index');
    localizedRoute('/pages/add_page', [PagesController::class, 'add_page'], 'add_page.index');
    localizedRoute('/terms', [PagesController::class, 'terms'], 'terms.index');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        localizedRoute('/', [VendorProfileController::class, 'index'], 'index');
        localizedRoute('/account', [VendorProfileController::class, 'account'], 'account.index');
        localizedRoute('/password', [VendorProfileController::class, 'password'], 'password.index');
        localizedRoute('/onboarding', [VendorProfileController::class, 'onboarding'], 'onboarding.index');
    });

    // Media Routes for Vendor

});

Route::prefix('media')->name('media.')->group(function () {
    localizedRoute('/show', [MediaFileController::class, 'index'], 'show');
    localizedRoute('/save', [MediaFileController::class, 'upload'], 'save');
    localizedRoute('/delete', [MediaFileController::class, 'delete'], 'delete');
    localizedRoute('/select', [MediaFileController::class, 'select'], 'select');
});

$urlStyle = config('localization.url_style', 'query');
if ($urlStyle === 'suffix') {
    Route::pattern('locale', implode('|', config('localization.supported_locales')));

    Route::get('/', function () {
        return redirect('/' . config('localization.fallback_locale', 'en'));
    });
}



// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/',            [CartController::class, 'index'])->name('index');
    Route::post('/add',        [CartController::class, 'add'])->name('add');
    Route::patch('/{cartItem}', [CartController::class, 'update'])->name('update');
    Route::delete('/{cartItem}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/',         [CartController::class, 'clear'])->name('clear');
});

// Checkout Routes
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/',             [CheckoutController::class, 'index'])->name('index');
    Route::post('/order-type',  [CheckoutController::class, 'setOrderType'])->name('order-type');
    Route::post('/tip',         [CheckoutController::class, 'setTip'])->name('tip');
    Route::post('/coupon',      [CheckoutController::class, 'applyCoupon'])->name('coupon.apply');
    Route::delete('/coupon',    [CheckoutController::class, 'removeCoupon'])->name('coupon.remove');

    // Logic Routes
    Route::post('/guest', [ProfileController::class, 'saveGuest'])->name('guest');
    Route::post('/otp/send', [ProfileController::class, 'sendOtp'])->name('otp.send');
    Route::post('/otp/verify', [ProfileController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/promo/apply', [ProfileController::class, 'applyPromo'])->name('promo.apply');
    Route::delete('/promo/remove', [ProfileController::class, 'removePromo'])->name('promo.remove');
    Route::post('/place-order', [ProfileController::class, 'placeOrder'])->name('place-order');
});

// Vendor-Specific Customer Facing Routes
Route::group(['prefix' => '{username}'], function () {
    // Vendor Shop Home
    Route::get('/', [ProfileController::class, 'index'])->name('profile.show');

    // Other Shop Pages
    Route::get('/menu', [ProfileController::class, 'menu'])->name('profile.menu');
    Route::get('/items', [ProfileController::class, 'all_items'])->name('profile.items');
    Route::get('/special', [ProfileController::class, 'special_items'])->name('profile.special');
    Route::get('/orders', [ProfileController::class, 'my_order'])->name('profile.my_orders');
    Route::get('/order/{order_id}', [ProfileController::class, 'view_order'])->name('profile.view_order');
    Route::get('/checkout', [ProfileController::class, 'checkout'])->name('checkout');

    // Item Details
    Route::get('/item/{slug}', [ProfileController::class, 'item_details'])->name('item.details');
});
