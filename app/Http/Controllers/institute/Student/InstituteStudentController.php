<?php

namespace App\Http\Controllers\institute\Student;

use App\Http\Controllers\Controller;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstituteStudentController extends Controller
{
    // URI: /
    // SUM:
    public function getInstituteStudentIndex(Request $request): JsonResponse
    {
        $student=StudentInformation::toBase()
            ->orderBy('id',)
            ->paginate(15);

        return response()->json([
            'student' => $student,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
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
