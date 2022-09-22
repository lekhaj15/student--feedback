<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeCategoryController extends Controller
{



    // URI: /api/institute/category


    // SUM: get all the category details
    public function getGradeCategoryIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
        $category=GradeCategory::toBase()
            ->where('id','=', $institute_id )

        ->orderBy('id',)
            ->paginate(15);

        return response()->json([
            'category' => $category,
        ], JsonResponse::HTTP_OK);
    }

    // SUM: get all the category details
    public function getGradeCategory(Request $request): JsonResponse
    {
        $categories=GradeCategory::toBase()

            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'categories' => $categories,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /api/institute/category/store
    // SUM: store the category
    public function postGradeCategoryStore(Request $request): JsonResponse
    {
        $request->validate([
        'category_name' => 'required|string|max:45',
    ]);
        $institute_id = auth('institute')->id();
        $category_name = $request->input('category_name');

        $grade_category =GradeCategory::create([
            'institute_id'=>$institute_id,
            'category_name' => $category_name,
        ]);
        return response()->json([
            'grade_category' => $grade_category,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /http://127.0.0.1:8000/api/institute/category/show
    // SUM: displays the category
    public function getGradeCategoryShow(Request $request,int $id): JsonResponse
    {

        $category= GradeCategory::where('id', '=',$id)
            ->first();

        return response()->json([
            'category' => $category,



        ], JsonResponse::HTTP_OK);
    }


    // URI: /api/institute/category/update
    // SUM: update the category
    public function patchGradeCategoryUpdate(Request $request, $id): JsonResponse
    {

        $category_name = $request->input('category_name');
//        dd($category_name);
        $test=GradeCategory::toBase()
        ->where([
            ['id','=',$id],
            ])

            ->update([
                'category_name'=> $category_name
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/institute/category/delete
    // SUM: deletes the category data
    public function deleteGradeCategory(Request $request,int $id): JsonResponse
    {
        $category=GradeCategory::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
