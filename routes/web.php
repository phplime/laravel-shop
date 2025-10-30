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

Route::get('/{slug}', [ProfileController::class, 'index']);

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
