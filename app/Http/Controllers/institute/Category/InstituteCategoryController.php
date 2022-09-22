<?php

namespace App\Http\Controllers\institute\Category;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstituteCategoryController extends Controller
{
    // URI: /
    // SUM:
    public function getInstituteGradeIndex(Request $request): JsonResponse
    {
        $grade=GradeCategory::toBase()
            ->orderBy('id',)
            ->paginate(15);

        return response()->json([
            'grade' => $grade,
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
