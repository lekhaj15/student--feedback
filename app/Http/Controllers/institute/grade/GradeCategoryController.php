<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeCategoryController extends Controller
{
    // URI: /
    // SUM:
    public function getGradeCategoryIndex(Request $request): JsonResponse
    {
        $category=GradeCategory::toBase()
            ->get();

        return response()->json([
            'category' => $category,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/category
    // SUM:
    public function postGradeCategoryStore(Request $request): JsonResponse
    {
        $request->validate([
            'category_name' => 'required|string|max:45',
        ]);
        $category_name = $request->input('category_name');

        $grade_category =GradeCategory::create([
            'category_name' => $category_name,
        ]);
        return response()->json([
            'grade_category' => $grade_category,
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
