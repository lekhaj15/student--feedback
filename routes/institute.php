<?php

use App\Http\Controllers\institute\grade\GradeCategoryController;

use App\Http\Controllers\institute\grade\GradeSubCategoryController;
use App\Http\Controllers\institute\grade\StaffInformationController;
use App\Http\Controllers\institute\grade\StudentInformationController;
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
// api/institute




Route::post('/category/store', [GradeCategoryController::class, 'postGradeCategoryStore']);
Route::get('/category/index', [GradeCategoryController::class, 'getGradeCategoryIndex']);
Route::get('/category/show/{id}', [GradeCategoryController::class, 'getGradeCategoryShow']);
Route::delete('/category/{id}', [GradeCategoryController::class, 'deleteGradeCategory']);
Route::patch('/category/update/{id}',[GradeCategoryController::class, 'patchGradeCategoryUpdate']);

<<<<<<< Updated upstream
=======
Route::delete('staff/delete/{id}', [StaffInformationController::class, 'deleteStaffInformation']);
Route::get('/staff/index', [StaffInformationController::class, 'getStaffInformationIndex']);
Route::post('/staff/store/{id}', [StaffInformationController::class,'postStaffInformationStore']);
Route::get('/staff/show/{id}', [StaffInformationController::class,'getStaffInformationShow']);
Route::patch('/staff/update/{id}',[StaffInformationController::class,'patchStaffInformationUpdate']);


>>>>>>> Stashed changes

Route::delete('staff/delete', [StaffInformationController::class, 'deleteStaffInformation']);
Route::get('/staff/index', [StaffInformationController::class, 'getStaffInformationIndex']);
Route::post('/staff/store', [StaffInformationController::class,'postStaffInformationStore']);
Route::get('/staff/show', [StaffInformationController::class,'getStaffInformationShow']);

Route::post('/subcategory/store', [GradeSubCategoryController::class, 'postSubCategoryStore']);
Route::get('/subcategory/index', [GradeSubCategoryController::class, 'getGradeSubCategoryIndex']);
Route::get('/subcategory/show/{id}',[GradeSubCategoryController::class,'getGradeSubCategoryShow']);
Route::delete('/subcategory/delete/{id}',[GradeSubCategoryController::class,'deleteGradeSubCategory']);
Route::patch('/subcategory/update/{id}',[GradeSubCategoryController::class,'patchGradeSubCategoryUpdate']);


Route::get('/student/index',[StudentInformationController::class,'getStudentInformationIndex']);
Route::get('/student/show/{id}',[StudentInformationController::class,'getStudentInformationShow']);
Route::delete('/student/delete/{id}',[StudentInformationController::class,'deleteStudentInformation']);
Route::post('/student/store',[StudentInformationController::class,'postStudentInformationStore']);
Route::patch('/student/update/{id}',[StudentInformationController::class,'patchStudentInformationUpdate']);

<<<<<<< Updated upstream
=======
Route::get('/student/index',[StudentInformationController::class,'getStudentInformationIndex']);
Route::get('/student/information/show',[StudentInformationController::class,'getStudentInformationShow']);
Route::delete('/student/delete',[StudentInformationController::class,'deleteStudentInformation']);
Route::post('/student/store',[StudentInformationController::class,'postStudentInformationStore']);
Route::patch('/student/update',[StudentInformationController::class,'patchStudentInformationUpdate']);
Route::get('/student/edit',[StudentInformationController::class,'getStudentInformationEdit']);
>>>>>>> Stashed changes



