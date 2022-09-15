<?php

use App\Http\Controllers\admin\auth\AdminLoginController;
use App\Http\Controllers\admin\auth\AdminProfileController;
use App\Http\Controllers\admin\auth\AdminRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'auth'
], function()
{
    Route::post('/register', [AdminRegisterController::class, 'postAdminRegister']);

    Route::post('/login', [AdminLoginController::class, 'postAdminLogin']);
    Route::post('/logout', [AdminLoginController::class, 'postAdminLogout'])->middleware(['jwt', 'auth:admin']);

    Route::get('/me', [AdminProfileController::class, 'getAdminIndex'])->middleware(['jwt', 'auth:admin']);

}
);
Route::group([
    'middleware' => ['jwt', 'auth:admin'], // /api/admin
], function () {
});

