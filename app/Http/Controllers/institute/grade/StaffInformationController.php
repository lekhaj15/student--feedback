<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\staff\StaffInformation;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class StaffInformationController extends Controller
{
    // URI: /institute/staff/index
    // SUM: get all staff details
    public function getStaffInformationIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();

        $staffinformation=StaffInformation::with(['categoryInformation','subcategoryInformation'])
            ->where('id','=', $institute_id )
            ->paginate(15);

        return response()->json([
            'staffinformation' => $staffinformation,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/staff/store
    // SUM: store the staff info
    public function postStaffInformationStore(Request $request): JsonResponse
    {
        $institute_id = auth('institute')->id();


        $staff_id = $request->input('staff_id');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $staff_name = $request->input('staff_name');
        $staff_email = $request->input('staff_email');
        $staff_phone = $request->input('staff_phone');
        $staff_dob = $request->input('staff_dob');
        $staff_password = $request->input('staff_password');


        $staff =StaffInformation::create([
            'institute_id'=>$institute_id,
            'staff_id' => $staff_id,
            'category_id'=> $category_id,
            'subcategory_id'=> $subcategory_id,
            'staff_name' => $staff_name,
            'staff_email' => $staff_email,
            'staff_phone' => $staff_phone,
            'staff_dob' => $staff_dob,
            'staff_password'=> Hash::make('staff'),

          ]);


        return response()->json([
            'staff' => $staff,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM: displays the staff data
    public function getStaffInformationShow( Request $request , int $id): JsonResponse
    {
        $staff = StaffInformation::where('id', '=', $id)
            ->first();
        return response()->json([

            'staff' => $staff,
        ]);
    }




    // URI: /
        // SUM: updates the staff information
    public function patchStaffInformationUpdate(Request $request, int $id): JsonResponse

    {

                $staff_id = $request->input('staff_id');
                $staff_name = $request->input('staff_name');
                $category_id = $request->input('category_id');
                $staff_email = $request->input('staff_email');

                $staff_phone=$request->input('staff_phone');
                $staff_dob = $request->input('staff_dob');
                $subcategory_id = $request->input('subcategory_id');

                StaffInformation::toBase()
                ->where('id','=',$id)
                    ->update(['staff_id'=> $staff_id,
                        'staff_name'=> $staff_name,
                        'staff_email'=>$staff_email,
                        'staff_phone'=>$staff_phone,

                        'staff_dob'=> $staff_dob,
                        'category_id'=>$category_id,
                        'subcategory_id'=>$subcategory_id,

                    ]);

        return response()->json([
            'success' => 'update success',
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM: deletes the staff data
    public function deleteStaffInformation(Request $request,int $id): JsonResponse
    {
        $staff=StaffInformation::where('id','=',$id)->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
