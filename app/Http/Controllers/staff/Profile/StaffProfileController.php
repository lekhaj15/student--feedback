<?php

namespace App\Http\Controllers\staff\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffProfileController extends Controller
{
    // URI: /
    // SUM:
    public function getStaffProfileIndex(Request $request): JsonResponse
    {
        $staffs_id=auth('staff')->id();

        $staff_information=DB::table('staff_information')
            ->select('staff_information.id','staff_information.created_at','staff_information.staff_name','staff_information.staff_id',
                'staff_information.staff_email','staff_information.staff_phone','staff_information.staff_dob',
                'grade_categories.category_name','grade_sub_categories.subcategory_name','institutes.full_name')

            ->leftJoin('grade_categories', 'student_information.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'student_information.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'student_information.institute_id', '=', 'institutes.id')
            ->where('staff_information.id',$staffs_id)
            ->first();

        return response()->json([
            'profile' => $staff_information,
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
