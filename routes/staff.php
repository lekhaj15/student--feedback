<?php

use App\Http\Controllers\staff\feedback\StaffFeedbackController;
use App\Models\institute\staff\StaffInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => 'auth'
],

    function()
    {


        Route::post('/login', [\App\Http\Controllers\staff\auth\StaffLoginController::class, 'postStaffLogin']);
        Route::post('/logout', [\App\Http\Controllers\staff\auth\StaffLoginController::class, 'postStaffLogout'])->middleware(['jwt', 'auth:staff']);

        Route::get('/me', [\App\Http\Controllers\staff\auth\StaffProfileController::class, 'getStaffIndex'])->middleware(['jwt', 'auth:staff']);

    });
Route::group([
    'middleware' => ['jwt', 'auth:staff'], // /api/institute
], function () {

    Route::get('/feedback/{topic_id}', [StaffFeedbackController::class, 'getStaffFeedbackIndex']);
    Route::get('/topic', [StaffFeedbackController::class, 'getTopicIndex']);
    Route::get('/profile', [\App\Http\Controllers\staff\Profile\StaffProfileController::class, 'getStaffProfileIndex']);
    Route::post('/feedback/store', [StaffFeedbackController::class, 'postFeedbackStore']);



});
