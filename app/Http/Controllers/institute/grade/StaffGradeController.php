<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;

use App\Models\institute\staffgrade\StaffGrade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StaffGradeController extends Controller
{
    // URI: /
    // SUM:
    public function getstaffgradeIndex(Request $request): JsonResponse
    {
        $staff=StaffGrade::toBase()
            ->get();
        return response()->json([
            'staff' => $staff,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function poststaffgradeStore(Request $request): JsonResponse
    {
        $institute_id = auth('institute')->id();

        $s_id = $request->input('s_id');
        $category_id = $request->input('category_id');
        $subcategory_id= $request->input('subcategory_id');

        $staff = StaffGrade::create([
            'institute_id'=>$institute_id,

            's_id'=> $s_id,
            'category_id'=> $category_id,
            'subcategory_id'=> $subcategory_id,
        ]);


        return response()->json([
            'staff' => $staff,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getstaffgradeShow($id): JsonResponse
    {
        $staff=StaffGrade::where('id','=',$id);
        return response()->json([
            'staff' => $staff,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /
    // SUM:
    public function patchstaffgradeUpdate(Request $request, $id): JsonResponse
    {
        $s_id = $request->input('s_id');
        $category_id = $request->input('category_id');
        $subcategory_id= $request->input('subcategory_id');

        StaffGrade::toBase()
            ->where('id','=',$s_id)
            ->update(['s_id' => $s_id,
                'category_id'=> $category_id,
                'subcategory_id'=>$subcategory_id,]);

        return response()->json([
            'update' => 'success',
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deletestaffgradeDestroy($id): JsonResponse
    {
        $staff = StaffGrade::where('id','=',$id)->delete();
        return response()->json([
            'delete' => 'success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
