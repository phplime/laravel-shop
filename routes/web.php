<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;


Route::get('/assets/plugins/commoncss.php', function () {
    // Make sure to set CSS header
    header('Content-Type: text/css');

    // Include your PHP file manually
    include public_path('assets/plugins/commoncss.php');exit();
});

Route::get('/', [FrontendController::class, 'index']);

        /* ======================================
        Profile Controller
======================================== */
Route::controller(ProfileController::class)->group(function ()
{
    Route::get('/{slug}', [ProfileController::class, 'home'])->name('home.index');
    Route::get('/menu/{slug}', [ProfileController::class, 'menu'])->name('menu.index');
    Route::get('/all_items/{slug}', [ProfileController::class, 'all_items'])->name('all_items.index');
    Route::get('/special/items/{slug}', [ProfileController::class, 'special_items'])->name('special.index');
    Route::get('/my_profile/{slug}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/my_orders/{slug}', [ProfileController::class, 'my_order'])->name('my_orders.index');
    Route::get('/view-order/{order_id}/{slug}', [ProfileController::class, 'view_order'])->name('view_order.index');
    Route::get('/checkout/{slug}', [ProfileController::class, 'checkout'])->name('checkout.index');
});


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
