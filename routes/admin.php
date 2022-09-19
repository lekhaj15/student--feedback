<?php

use App\Http\Controllers\admin\auth\AdminLoginController;
use App\Http\Controllers\admin\auth\AdminProfileController;
use App\Http\Controllers\admin\auth\AdminRegisterController;
use App\Http\Controllers\institute\grade\GradeCategoryController;
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

    Route::post('/institute/store', [\App\Http\Controllers\institute\institute\InstituteController::class, 'postStore']);
    Route::get('/institute/index', [\App\Http\Controllers\institute\institute\InstituteController::class, 'getIndex']);
    Route::get('/institute', [\App\Http\Controllers\institute\institute\InstituteController::class, 'getInstitute']);
    Route::get('/institute/show/{id}/edit', [\App\Http\Controllers\institute\institute\InstituteController::class, 'getShow']);
    Route::delete('/institute/delete/{id}', [\App\Http\Controllers\institute\institute\InstituteController::class, 'deleteDestroy']);
    Route::patch('/institute/update/{id}', [\App\Http\Controllers\institute\institute\InstituteController::class, 'patchUpdate']);
});

