<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeCategoryController extends Controller
{
<<<<<<< Updated upstream
    // URI: /api/institute/category
=======
    // URI: /http://127.0.0.1:8000/api/institute/category/get
>>>>>>> Stashed changes
    // SUM: get all the category details
    public function getGradeCategoryIndex(Request $request): JsonResponse
    {
        $category=GradeCategory::toBase()
            ->get();

        return response()->json([
            'category' => $category,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/category/store
    // SUM: store the category
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

    // URI: /http://127.0.0.1:8000/api/institute/category/show
    // SUM: displays the category
    public function getGradeCategoryShow($id,$category_name): JsonResponse
    {
        return response()->json([
            'category_id' => $id,
            'category_name' => $category_name,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/category/edit
    // SUM: edit the category
    public function getGradeCategoryEdit($id): JsonResponse
    {
        $category=GradeCategory::where('category_id','=','$id')->first();
        return response()->json([
            'category' => $category,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /http://127.0.0.1:8000/api/institute/category/update
    // SUM: update the category
    public function patchGradeCategoryUpdate(Request $request, $id): JsonResponse
    {
        $id=$request->input('id');
        $category_name=$request->input('category_name');

        GradeCategory::where(['id','=','$id'])->update($id,$category_name);
        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/institute/category/delete
    // SUM: deletes the category data
    public function deleteGradeCategory($id): JsonResponse
    {
        $category=GradeCategory::where('category_id','=','$id')->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
