<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class GradeSubCategoryController extends Controller
{
    // URI: /api/institute/subcategory/index
    // SUM: get all the subcategory details
    public function getGradeSubCategoryIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $subcategory=GradeSubCategory::with(['subcategoryInformation'])

            ->where('institute_id','=', $institute_id )

            ->orderBy('category_id')
            ->paginate(15);

        return response()->json([
            'subcategory' => $subcategory,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory/store
    // SUM:
    public function postSubCategoryStore(Request $request): JsonResponse
    {
        $request->validate([
            'subcategory_name' => 'required|string|max:45',

        ]);
        $institute_id = auth('institute')->id();
        $category_id = $request->input('category_id');
        $subcategory_name = $request->input('subcategory_name');

        $grade_category =GradeSubCategory::create([
            'institute_id'=>$institute_id,
            'category_id' => $category_id,
            'subcategory_name' => $subcategory_name,
        ]);
        return response()->json([
            'grade_category' => $grade_category,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /api/institute/subcategory/show
    // SUM:display the values
    public function getGradeSubCategoryShow( Request $request,int $id): JsonResponse
    {
        $subcategory=GradeSubCategory::where('id','=',$id)
            ->first();

        return response()->json([
            'subcategory'=>$subcategory,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory/category_id
    // SUM:display the values
    public function getGradeSubCategory( Request $request,int $category_id): JsonResponse
    {
        $subcategory=GradeSubCategory::where('category_id','=',$category_id)
            ->get();

        return response()->json([
            'subcategory'=>$subcategory,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /api/institute/subcategory
    // SUM:
    public function patchGradeSubCategoryUpdate(Request $request,int $id): JsonResponse
    {

//        dd( $id);
        $category_id=$request->input('category_id');

        $subcategory_name = $request->input('subcategory_name');
//        dd($category_name);
        $test=GradeSubCategory::toBase()
            ->where(
                'id','=',$id
            )

            ->update([
                'subcategory_name'=> $subcategory_name,
                'category_id'=>$category_id,
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/institute/subcategory/delete
    // SUM: delete subcategory data
    public function deleteGradeSubCategory(Request $request,int $id): JsonResponse
    {

        $subcategory= GradeSubCategory::where('id', '=', $id)

            ->delete();

        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
