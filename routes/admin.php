<?php

use App\Http\Controllers\admin\auth\AdminLoginController;
use App\Http\Controllers\admin\auth\AdminProfileController;
use App\Http\Controllers\admin\auth\AdminRegisterController;
use App\Http\Controllers\institute\grade\GradeCategoryController;
use App\Http\Controllers\institute\institute\InstituteController;
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
    Route::get('/admin-dashboard', [\App\Http\Controllers\admin\AdminDashboardController::class, 'getAdminDashboardIndex']);
    Route::get('/admin-staff', [\App\Http\Controllers\admin\Staff\AdminStaffController::class, 'getAdminStaffIndex']);
    Route::get('/admin-student', [\App\Http\Controllers\admin\Student\AdminStudentController::class, 'getAdminStudentIndex']);;
    Route::get('/admin-grade', [\App\Http\Controllers\admin\Grade\AdminGradeController::class, 'getAdminGradeIndex']);;




    Route::get('/institute-information/index/{institute_id}', [InstituteController::class, 'getInstituteInformationIndex']);
    Route::post('/institute/store', [InstituteController::class, 'postStore']);
    Route::get('/institute/index', [InstituteController::class, 'getIndex']);
    Route::get('/institute', [InstituteController::class, 'getInstitute']);
    Route::get('/institute/show/{id}/edit', [InstituteController::class, 'getShow']);
    Route::delete('/institute/delete/{id}', [InstituteController::class, 'deleteDestroy']);
    Route::patch('/institute/update/{id}', [InstituteController::class, 'patchUpdate']);
});

