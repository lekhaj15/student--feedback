<?php

use App\Models\institute\staff\StaffInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group([],

    function()
    {


        Route::post('/login', [StaffInformation::class, 'postStaffLogin']);
        Route::post('/logout', [StaffInformation::class, 'postStaffLogout'])->middleware(['jwt', 'auth:staff']);

        Route::get('/me', [StaffProfileController::class, 'getStaffIndex'])->middleware(['jwt', 'auth:staff']);

    });
