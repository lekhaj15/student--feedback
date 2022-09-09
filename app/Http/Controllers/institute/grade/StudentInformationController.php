<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentInformationController extends Controller
{
    // URI: /
    // SUM:as
    public function getIndex(Request $request): JsonResponse
    {
        $studentinformation=StudentInformation::toBase()
            ->get();

        return response()->json([
            'studentinformation' => $studentinformation,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/student/
    // SUM:
    public function postStore(Request $request): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getShow($id): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function getEdit($id): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function patchUpdate(Request $request, $id): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deleteDestroy($id): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
