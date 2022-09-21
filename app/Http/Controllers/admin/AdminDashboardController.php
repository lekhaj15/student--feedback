<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    // URI: /
    // SUM:
    public function getAdminDashboardIndex(Request $request): JsonResponse
    {
        $categorycount= DB::table('grade_categories')->count();
        $subcategorycount= DB::table('grade_sub_categories')->count();
        $studentcount= DB::table('student_information')->count();
        $staffcount= DB::table('staff_information')->count();
        $institutecount= DB::table('institutes')->count();



        return response()->json([
            'category_count'=>$categorycount,
            'subcategory_count'=>$subcategorycount,
            'studentcount'=>$studentcount,
            'staffcount'=>$staffcount,
            'institutecount'=>$institutecount,

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
