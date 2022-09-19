<?php

use App\Http\Controllers\student\auth\StudentLoginController;
use App\Http\Controllers\student\auth\StudentProfileController;
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
