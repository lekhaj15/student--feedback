<?php

use App\Http\Controllers\institute\Auth\InstituteLoginController;
use App\Http\Controllers\institute\Auth\InstituteProfileController;
use App\Http\Controllers\institute\Auth\InstituteRegisterController;
use App\Http\Controllers\institute\grade\GradeCategoryController;
use App\Http\Controllers\institute\grade\GradeSubCategoryController;
use App\Http\Controllers\institute\grade\StaffGradeController;
use App\Http\Controllers\institute\grade\StaffInformationController;
use App\Http\Controllers\institute\grade\StudentInformationController;
use App\Http\Controllers\institute\questions\TopicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/register', [InstituteRegisterController::class, 'postInstituteRegister']);

    Route::post('/login', [InstituteLoginController::class, 'postInstituteLogin']);
    Route::post('/logout', [InstituteLoginController::class, 'postInstituteLogout'])->middleware(['jwt', 'auth:institute']);

    Route::get('/me', [InstituteProfileController::class, 'getInstituteIndex'])->middleware(['jwt', 'auth:institute']);
});


Route::group([
    'middleware' => ['jwt', 'auth:institute'], // /api/institute
], function () {

    Route::post('/category/store', [GradeCategoryController::class, 'postGradeCategoryStore']);
    Route::get('/category/index', [GradeCategoryController::class, 'getGradeCategoryIndex']);
    Route::get('/category/show/{id}', [GradeCategoryController::class, 'getGradeCategoryShow']);
    Route::delete('/category/delete/{id}', [GradeCategoryController::class, 'deleteGradeCategory']);
    Route::patch('/category/update/{id}', [GradeCategoryController::class, 'patchGradeCategoryUpdate']);


    Route::delete('staff/delete/{id}', [StaffInformationController::class, 'deleteStaffInformation']);
    Route::get('/staff/index', [StaffInformationController::class, 'getStaffInformationIndex']);
    Route::post('/staff/store', [StaffInformationController::class, 'postStaffInformationStore']);
    Route::get('/staff/show/{id}', [StaffInformationController::class, 'getStaffInformationShow']);
    Route::patch('/staff/update/{id}', [StaffInformationController::class, 'patchStaffInformationUpdate']);


    Route::delete('staffgrade/delete/{id}', [StaffGradeController::class, 'deletestaffgradeDestroy']);
    Route::get('/staffgrade/index', [StaffGradeController::class, 'getstaffgradeIndex']);
    Route::post('/staffgrade/store', [StaffGradeController::class, 'poststaffgradeStore']);
    Route::get('/staffgrade/show/{id}', [StaffGradeController::class, 'getstaffgradeShow']);
    Route::patch('/staffgrade/update/{id}', [StaffGradeController::class, 'patchstaffgradeUpdate']);


    Route::post('/subcategory/store', [GradeSubCategoryController::class, 'postSubCategoryStore']);
    Route::get('/subcategory/index', [GradeSubCategoryController::class, 'getGradeSubCategoryIndex']);
    Route::get('/subcategory/show/{id}', [GradeSubCategoryController::class, 'getGradeSubCategoryShow']);
    Route::delete('/subcategory/delete/{id}', [GradeSubCategoryController::class, 'deleteGradeSubCategory']);
    Route::patch('/subcategory/update/{id}', [GradeSubCategoryController::class, 'patchGradeSubCategoryUpdate']);


    Route::get('/student/index', [StudentInformationController::class, 'getStudentInformationIndex']);
    Route::get('/student/show/{id}', [StudentInformationController::class, 'getStudentInformationShow']);
    Route::delete('/student/delete/{id}', [StudentInformationController::class, 'deleteStudentInformation']);
    Route::post('/student/store', [StudentInformationController::class, 'postStudentInformationStore']);
    Route::patch('/student/update/{id}', [StudentInformationController::class, 'patchStudentInformationUpdate']);


    Route::post('/topic/store', [TopicController::class, 'postquestionstopicStore']);
    Route::get('/topic/index', [TopicController::class, 'getquestionstopicIndex']);
    Route::get('/topic/show/{id}', [TopicController::class, 'getquestionstopicShow']);
    Route::delete('/topic/delete/{id}', [TopicController::class, 'deletequestionstopicDestroy']);
    Route::patch('/topic/update/{id}', [TopicController::class, 'patchquestionstopicUpdate']);


});

