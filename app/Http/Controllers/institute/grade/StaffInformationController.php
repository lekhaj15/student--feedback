<?php

namespace App\Http\Controllers\institute\grade;

use App\Http\Controllers\Controller;
use App\Models\institute\staff\StaffInformation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StaffInformationController extends Controller
{
    // URI: /
    // SUM: get all staff details
    public function getStaffInformationIndex(Request $request): JsonResponse
    {
        $staffinformation=StaffInformation::toBase()->get();
        return response()->json([
            'staffinformation' => $staffinformation,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /http://127.0.0.1:8000/api/institute/staff/store
    // SUM: store the staff info
    public function postStaffInformationStore(Request $request): JsonResponse
    {
//        $request->validate([
//            'staff_name' => 'required|string|max:45',
//        ]);

//        $id = $request->input('id');
        $staff_id = $request->input('staff_id');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $staff_name = $request->input('staff_name');
        $staff_email = $request->input('staff_email');
        $staff_phone = $request->input('staff_phone');
        $staff_dob = $request->input('staff_dob');
        $staff_password = $request->input('staff_password');


        $staff_information =StaffInformation::create([
//            'id' => $id,
            'staff_id' => $staff_id,
            'category_id'=> $category_id,
            'subcategory_id'=> $subcategory_id,
            'staff_name' => $staff_name,
            'staff_email' => $staff_email,
            'staff_phone' => $staff_phone,
            'staff_dob' => $staff_dob,
            'staff_password' => $staff_password,
<<<<<<< Updated upstream
        'staff_category_id'=> $staff_category_id,]);
=======
          ]);

>>>>>>> Stashed changes
        return response()->json([
            'staff_information' => $staff_information,
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

<<<<<<< Updated upstream
    // URI: /
    // SUM: edits the staff info
 /*   public function getStaffInformationEdit($id): JsonResponse
    {
        $staff=StaffInformation::where('staff_id','=','$id')->first();
        return response()->json([
            'staffinformation' => $staffinformation,
=======
>>>>>>> Stashed changes
        ], JsonResponse::HTTP_OK);
    }*/


    // URI: /
<<<<<<< Updated upstream
    // SUM:
   /* public function patchUpdate(Request $request, $id): JsonResponse
=======
    // SUM: updates the staff information
    public function patchStaffInformationUpdate(Request $request, int $id): JsonResponse
>>>>>>> Stashed changes
    {

                $staff_id = $request->input('staff_id');
                $staff_name = $request->input('staff_name');
                $category_id = $request->input('category_id');
                $staff_email = $request->input('staff_email');
                $staff_password = $request->input('staff_password');
                $staff_phone=$request->input('staff_phone');
                $staff_dob = $request->input('staff_dob');
                $subcategory_id = $request->input('subcategory_id');

                StaffInformation::toBase()
                ->where('id','=',$id)
                    ->update(['staff_id'=> $staff_id,
                        'staff_name'=> $staff_name,
                        'staff_email'=>$staff_email,
                        'staff_phone'=>$staff_phone,
                        'staff_password'=>$staff_password,
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
        $staff=StaffInformation::where('staff_id','=',$id)->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }*/
}
