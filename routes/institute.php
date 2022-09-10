<?php

use App\Http\Controllers\institute\grade\GradeCategoryController;
use App\Http\Controllers\institute\grade\GradeSubCategoryController;
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

Route::post('/category', [GradeCategoryController::class, 'postGradeCategoryStore']);
Route::get('/category', [GradeCategoryController::class, 'getGradeCategoryIndex']);
Route::get('category', [GradeCategoryController::class, 'getGradeCategoryShow']);
Route::delete('/category', [GradeCategoryController::class, 'deleteGradeCategory']);
Route::get('/category/edit',[GradeCategoryController::class,'getGradeCategoryEdit']);
Route::get('/category/edit',[GradeCategoryController::class,'getGradeCategoryEdit']);



Route::post('/subcategory/store', [GradeSubCategoryController::class, 'postSubCategoryStore']);
Route::get('/subcategory/index', [GradeSubCategoryController::class, 'getGradeSubCategoryIndex']);
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
