<?php

namespace App\Http\Controllers\institute\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstituteSubCategoryController extends Controller
{
    // URI: /
    // SUM:
    public function getInstituteSubgradeIndex(Request $request): JsonResponse
    {
       $subcategory = GradeSubCategory::toBase()
           ->orderBy('id')
           ->paginate(15);

        return response()->json([
            'subcategory' => $subcategory,
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
