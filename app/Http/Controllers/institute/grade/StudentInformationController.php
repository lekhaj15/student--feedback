<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentInformationController extends Controller
{
    // URI: /student/index
    // SUM:as
    public function getStudentInformationIndex(Request $request): JsonResponse
    {
        $studentinformation=StudentInformation::toBase()
            ->get();

        return response()->json([
            'studentinformation' => $studentinformation,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/student/store
    // SUM:
    public function postStudentInformationStore(Request $request): JsonResponse
    {
        $request->validate([
            'student_name'=>'required|string|50',



        ]);
        $id = $request->input('id');
        $student_id = $request->input('student_id');
        $student_name = $request->input('student_name');
        $student_category_id = $request->input('student_category_id');
        $student_subcategory_id= $request->input('student_subcategory_id');
        $student_email = $request->input('student_email');
        $student_password = $request->input('student_password');
        $student_phone=$request->input('student_phone');
        $student_status = $request->input('student_status');
        $student_dob = $request->input('student_dob');

        $studentinformation =StudentInformation::create([
            'id' => $id,
            'student_id'=>$student_id,
            'student_name' => $student_name,
            'student_category_id'=>$student_category_id,'student_subcategory_id'=>$student_subcategory_id,
            'student_email'=>$student_email,
            'student_password'=>$student_password,
            'student_phone'=>$student_phone,
            'student_status'=>$student_status,
            'student_dob' => $student_dob
        ]);

        return response()->json([
            'studentinformation' => $studentinformation,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /student/information
    // SUM:display of student information
    public function getStudentInformationShow($id,$student_id,$student_name,$student_email,$student_phone,$student_status,$category_id,$subcategory_id): JsonResponse
    {
        return response()->json([
            'id'=>$id,
            'student_id' => $student_id,
            'student_name' => $student_name,
            'student_email' => $student_email,
            'student_phone' =>$student_phone,
            'student_status' => $student_status,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id

        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function getStudentInformationEdit($id): JsonResponse
    {
        $studentinformation = StudentInformation::where(['id','=','$id'])
        ->first();

        return response()->json([
            'studentinformation' => $studentinformation,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /student/update
    // SUM:update student information
    public function patchStudentInformationUpdate(Request $request, $id): JsonResponse
    {
        $id = $request->input('id');
        $student_id = $request->input('student_id');
        $student_name = $request->input('student_name');
        $student_category_id = $request->input('student_category_id');
        $student_subcategory_id= $request->input('student_subcategory_id');
        $student_email = $request->input('student_email');
        $student_password = $request->input('student_password');
        $student_phone=$request->input('student_phone');
        $student_status = $request->input('student_status');
        $student_dob = $request->input('student_dob');

        StudentInformation::where(['id','=','$id'])->update($id,$student_id,$student_name,$student_category_id,$student_dob,$student_status,$student_phone,$student_email,$student_password,$student_subcategory_id);

        return response()->json([
            'update' => 'success',
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/student/delete
    // SUM:delete student data
    public function deleteStudentInformation($id): JsonResponse
    {
        $student= StudentInformation::where('student_id','=',$id)->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
