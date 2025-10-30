<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;


Route::get('/', [FrontendController::class, 'index']);

Route::get('/{slug}', [ProfileController::class, 'index']);
