<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeSubCategoryController extends Controller
{
    // URI: /api/institute/subcategory
    // SUM: get all the subcategory details
    public function getGradeSubCategoryIndex(Request $request): JsonResponse
    {
        $subcategory=GradeSubCategory::toBase()
            ->get();


        return response()->json([
            'subcategory' => $subcategory,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory
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

    // URI: /api/institute/subcategory/show
    // SUM:display the values
    public function getGradeSubCategoryShow($id,$category_id,$subcategory_name): JsonResponse
    {
        return response()->json([
            'category_id' => $category_id,
            'subcategory_name'=>$subcategory_name,
            'subcategory_id'=>$id,

        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory/edit
    // SUM:edit subcategory information
    public function getGradeSubCategoryEdit($id): JsonResponse
    {
        $subcategory= GradeSubCategory::where(['subcategory_id','=',$id])
        ->first();
        return response()->json([
            'subcategory' => $subcategory,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory
    // SUM:
    public function patchUpdate(Request $request, $id): JsonResponse
    {
        return response()->json([
            'subcategory' => $subcategory,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/institute/subcategory
    // SUM: delete subcategory data
    public function deleteGradeSubCategory($id): JsonResponse
    {
        $subcategory= GradeSubCategory::where('subcategory_id','=',$id)->delete();
        return response()->json([

            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}