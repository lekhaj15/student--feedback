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

Route::post('/subcategory', [GradeSubCategoryController::class, 'postSubCategoryStore']);
Route::get('/subcategory', [GradeSubCategoryController::class, 'getGradeSubCategoryIndex']);
Route::get('/subcategory/show',[GradeSubCategoryController::class,'getGradeSubCategoryShow']);
Route::delete('/subcategory/delete',[GradeSubCategoryController::class,'deleteGradeSubCategory']);
Route::get('/subcategory/edit',[GradeSubCategoryController::class,'getGradeSubCategoryEdit']);
