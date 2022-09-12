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



<<<<<<< Updated upstream
Route::post('/category/store/{id}', [GradeCategoryController::class, 'postGradeCategoryStore']);
Route::get('/category/index', [GradeCategoryController::class, 'getGradeCategoryIndex']);
Route::get('/category/show/{id}', [GradeCategoryController::class, 'getGradeCategoryShow']);
Route::delete('/category/{id}', [GradeCategoryController::class, 'deleteGradeCategory']);
Route::get('/category/edit/{id}',[GradeCategoryController::class,'getGradeCategoryEdit']);
Route::patch('/category/update/{id}',[GradeCategoryController::class, 'patchGradeCategoryUpdate']);
=======
Route::post('/category/store', [GradeCategoryController::class, 'postGradeCategoryStore']);
Route::get('/category/index', [GradeCategoryController::class, 'getGradeCategoryIndex']);
Route::get('category/show/{id}', [GradeCategoryController::class, 'getGradeCategoryShow']);
Route::delete('/category/delete', [GradeCategoryController::class, 'deleteGradeCategory']);
Route::get('/category/edit',[GradeCategoryController::class,'getGradeCategoryEdit']);
Route::patch('/category/update',[GradeCategoryController::class, 'patchGradeCategoryUpdate']);
>>>>>>> Stashed changes

Route::delete('staff/delete', [StaffInformationController::class, 'deleteStaffInformation']);
Route::get('/staff/index', [StaffInformationController::class, 'getStaffInformationIndex']);
Route::post('/staff/store', [StaffInformationController::class,'postStaffInformationStore']);
Route::get('/staff/show', [StaffInformationController::class,'getStaffInformationShow']);

<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes



Route::post('/subcategory/store', [GradeSubCategoryController::class, 'postSubCategoryStore']);
Route::get('/subcategory/index', [GradeSubCategoryController::class, 'getGradeSubCategoryIndex']);
<<<<<<< Updated upstream
Route::get('/subcategory/show',[GradeSubCategoryController::class,'getGradeSubCategoryShow']);
Route::delete('/subcategory/delete',[GradeSubCategoryController::class,'deleteGradeSubCategory']);
Route::get('/subcategory/edit',[GradeSubCategoryController::class,'getGradeSubCategoryEdit']);

Route::patch('/subcategory/update',[GradeSubCategoryController::class,'patchGradeSubCategoryUpdate']);


Route::get('/student/index',[\App\Http\Controllers\institute\grade\StudentInformationController::class,'getStudentInformationIndex']);
Route::get('/student/information/show',[\App\Http\Controllers\institute\grade\StudentInformationController::class,'getStudentInformationShow']);
Route::delete('/student/delete',[\App\Http\Controllers\institute\grade\StudentInformationController::class,'deleteStudentInformation']);
Route::post('/student/store',[\App\Http\Controllers\institute\grade\StudentInformationController::class,'postStudentInformationStore']);
Route::patch('/student/update',[\App\Http\Controllers\institute\grade\StudentInformationController::class,'patchStudentInformationUpdate']);
Route::get('/student/edit',[\App\Http\Controllers\institute\grade\StudentInformationController::class,'getStudentInformationEdit']);

Route::post('/Subcategory', [GradeSubCategoryController::class, 'postSubCategoryStore']);
=======
Route::get('/subcategory/show/{id}',[GradeSubCategoryController::class,'getGradeSubCategoryShow']);
Route::delete('/subcategory/delete/{id}',[GradeSubCategoryController::class,'deleteGradeSubCategory']);
Route::get('/subcategory/edit/{id}',[GradeSubCategoryController::class,'getGradeSubCategoryEdit']);
Route::patch('/subcategory/update/{id}',[GradeSubCategoryController::class,'patchGradeSubCategoryUpdate']);


Route::get('/student/index',[StudentInformationController::class,'getStudentInformationIndex']);
Route::get('/student/information/show',[StudentInformationController::class,'getStudentInformationShow']);
Route::delete('/student/delete/{id}',[StudentInformationController::class,'deleteStudentInformation']);
Route::post('/student/store',[StudentInformationController::class,'postStudentInformationStore']);
Route::patch('/student/update',[StudentInformationController::class,'patchStudentInformationUpdate']);
Route::get('/student/edit',[StudentInformationController::class,'getStudentInformationEdit']);

>>>>>>> Stashed changes


