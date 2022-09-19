<?php

namespace App\Http\Controllers\student\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    // URI: /
    // SUM:
    public function getStudentIndex(Request $request): JsonResponse
    {
        return response()->json([
            'student' => auth('student')->user()
        ], JsonResponse::HTTP_OK);
    }
}
