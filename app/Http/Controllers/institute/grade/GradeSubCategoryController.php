<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeSubCategoryController extends Controller
{
    // URI: /
    // SUM:
    public function getIndex(Request $request): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postSubCategoryStore(Request $request): JsonResponse
    {
        $request->validate([
            'subcategory_name' => 'required|string|max:45',
        ]);
        $category_id = $request->input('category_id');
        $subcategory_name = $request->input('subcategory_name');

        $grade_category =GradeSubCategory::create([
            'category_id' => $category_id,
            'subcategory_name' => $subcategory_name,
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
