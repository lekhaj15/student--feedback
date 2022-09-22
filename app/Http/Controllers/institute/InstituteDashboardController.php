<?php

namespace App\Http\Controllers\institute;

use App\Http\Controllers\Controller;
use App\Models\institute\Auth\Institute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstituteDashboardController extends Controller
{
    // URI: /
    // SUM:
    public function getInstituteDashboardIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
        $categorycount= DB::table('grade_categories')
            ->where('id','=', $institute_id )
            ->count();
        $subcategorycount= DB::table('grade_sub_categories')
            ->where('id','=', $institute_id )
            ->count();
        $studentcount= DB::table('student_information')
            ->where('id','=', $institute_id )
            ->count();
        $staffcount= DB::table('staff_information')
            ->where('id','=', $institute_id )
            ->count();




        return response()->json([
            'category_count'=>$categorycount,
            'subcategory_count'=>$subcategorycount,
            'studentcount'=>$studentcount,
            'staffcount'=>$staffcount,
            ]);
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
