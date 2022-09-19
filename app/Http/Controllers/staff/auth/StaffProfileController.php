<?php

namespace App\Http\Controllers\staff\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StaffProfileController extends Controller
{
    // URI: /
    // SUM:
    public function getStaffIndex(Request $request): JsonResponse
    {
        return response()->json([
            'staff' => auth('staff')->user()
        ], JsonResponse::HTTP_OK);
    }
}
