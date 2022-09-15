<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    // URI: /
    // SUM:
    public function getAdminIndex(Request $request): JsonResponse
    {
        return response()->json([
            'admin' => auth('admin')->user()
        ], JsonResponse::HTTP_OK);
    }
}

