<?php

use App\Http\Controllers\student\auth\StudentLoginController;
use App\Http\Controllers\student\auth\StudentProfileController;
use App\Http\Controllers\student\feedback\StudentFeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth'
],

 function()
{


    Route::post('/login', [StudentLoginController::class, 'postStudentLogin']);
    Route::post('/logout', [StudentLoginController::class, 'postStudentLogout'])->middleware(['jwt', 'auth:student']);

    Route::get('/me', [StudentProfileController::class, 'getStudentIndex'])->middleware(['jwt', 'auth:student']);



});
Route::group([
    'middleware' => ['jwt', 'auth:student'], // /api/institute
], function () {

    Route::get('/feedback/{topic_id}', [StudentFeedbackController::class, 'getFeedbackIndex']);
    Route::get('/topic', [StudentFeedbackController::class, 'getTopicIndex']);
    Route::get('/profile', [\App\Http\Controllers\student\Profile\StudentProfileController::class, 'getProfileIndex']);
    Route::post('/feedback/store', [StudentFeedbackController::class, 'postFeedbackStore']);



});
