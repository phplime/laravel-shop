<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;

<<<<<<< Updated upstream
 Route::get('/', [FrontendController::class, 'index']);

 Route::get('/admin/dashboard', [DashboardController::class, 'index']);
=======
// Route::get('/{slug}', function () {
//     dd("here");
//     $controller = new ProfileController();
//     return $controller->index(); // or any other method
// });

Route::get('/', [FrontendController::class, 'index']);

Route::get('/{slug}', [ProfileController::class, 'index']);
>>>>>>> Stashed changes
