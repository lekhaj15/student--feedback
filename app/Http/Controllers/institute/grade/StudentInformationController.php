<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentInformationController extends Controller
{
    // URI: /student/index
    // SUM: get all the student information details
    public function getStudentInformationIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();

        $studentinformation=StudentInformation::with(['categoryInformation','subcategoryInformation'])
            ->where('institute_id','=', $institute_id )
            ->paginate(15);

        return response()->json([
            'student_information' => $studentinformation,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/student/store
    // SUM:
    public function postStudentInformationStore(Request $request): JsonResponse
    {
        $institute_id = auth('institute')->id();


        $student_id = $request->input('student_id');
        $student_name = $request->input('student_name');
        $category_id = $request->input('category_id');
        $subcategory_id= $request->input('subcategory_id');
        $student_email = $request->input('student_email');
        $student_password = $request->input('student_password');
        $student_phone=$request->input('student_phone');
        $student_status = $request->input('student_status');


        $student = StudentInformation::create([
            'institute_id'=>$institute_id,


            'student_id'=> $student_id,
            'student_name' => $student_name,
            'category_id'=> $category_id,
            'subcategory_id'=> $subcategory_id,
            'student_email'=> $student_email,
            'student_password'=> Hash::make('student'),
            'student_phone'=> $student_phone,
            'student_status'=> $student_status,

        ]);

        return response()->json([
            'student' => $student,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /student/information
    // SUM:display of student information
    public function getStudentInformationShow( Request $request, $id,): JsonResponse
    {

        $student=StudentInformation::with(['categoryInformation','subcategoryInformation'])
           ->where('id','=',$id)
            ->first();
        return response()->json([
            'student' =>$student,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /student/update
    // SUM:update student information
    public function patchStudentInformationUpdate(Request $request,int $id): JsonResponse
    {

        $student_id = $request->input('student_id');
        $student_name = $request->input('student_name');
        $category_id = $request->input('category_id');
        $subcategory_id= $request->input('subcategory_id');
        $student_email = $request->input('student_email');

        $student_phone=$request->input('student_phone');
        $student_status = $request->input('student_status');


        StudentInformation::toBase()
            ->where('id' ,'=', $id)
            ->update(['student_id' => $student_id,
                'student_name' =>$student_name,
                'category_id'=> $category_id,
                'subcategory_id'=>$subcategory_id,
                'student_email'=>$student_email,

                'student_phone'=>$student_phone,
                'student_status'=>$student_status,]);



        return response()->json([
            'update' => 'success',
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/student/delete
    // SUM:delete student data
    public function deleteStudentInformation(Request $request,int $id): JsonResponse
    {
        $student= StudentInformation::where('id','=',$id)->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
