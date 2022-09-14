<?php

namespace App\Http\Controllers\institute\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstituteProfileController extends Controller
{
    // URI: /api/Institute/auth/me
    // SUM: get auth response
    public function getInstituteIndex(): JsonResponse
    {
        return response()->json([
            'institute' => auth('institute')->user()
        ], JsonResponse::HTTP_OK);
    }
}
