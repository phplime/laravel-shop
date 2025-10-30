<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

 Route::get('/', [FrontendController::class, 'index']);

 Route::get('/admin/dashboard', [DashboardController::class, 'index']);
