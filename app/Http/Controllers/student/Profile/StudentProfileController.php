<?php

namespace App\Http\Controllers\student\Profile;

use App\Http\Controllers\Controller;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentProfileController extends Controller
{
    // URI: /
    // SUM:
    public function getProfileIndex(Request $request): JsonResponse
    {
        $stud_id=auth('student')->id();

        $student_information=DB::table('student_information')
            ->select('student_information.id','student_information.created_at','student_information.student_name','student_information.student_id',
                'student_information.student_email','student_information.student_phone','student_information.student_status',
                'grade_categories.category_name','grade_sub_categories.subcategory_name','institutes.full_name')

            ->leftJoin('grade_categories', 'student_information.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'student_information.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'student_information.institute_id', '=', 'institutes.id')
            ->where('student_information.id',$stud_id)
            ->first();

        return response()->json([
            'profile' => $student_information,
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
