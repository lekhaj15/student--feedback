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
        $staff=StaffInformation::toBase()->get();
        return response()->json([
            'satff' => $staff,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM: store the staff info
    public function postStaffInformationStore(Request $request): JsonResponse
    {
        $request->validate([
            'staff_name' => 'required|string|max:45',
        ]);


        $staff_id = $request->input('staff_id');
        $staff_name = $request->input('staff_name');
        $staff_email = $request->input('staff_email');
        $staff_phone = $request->input('staff_phone');
        $staff_dob = $request->input('staff_dob');
        $staff_password = $request->input('staff_password');
        $staff_category_id = $request->input('staff_category_id');

        $staff_information =StaffInformation::create([
            'staff_id' => $staff_id,
            'staff_name' => $staff_name,
            'staff_email' => $staff_email,
            'staff_phone' => $staff_phone,
            'staff_dob' => $staff_dob,
            'staff_password' => $staff_password,
        'staff_category_id'=> $staff_category_id,]);
        return response()->json([
            'staff_information' => $staff_information,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM: displays the staff data
    public function getStaffInformationShow($id,$staff_id,$staff_name,$staff_email,$staff_phone,$staff_dob,$staff_password): JsonResponse
    {
        return response()->json([
            'id' => $id,
            'staff_id' => $staff_id,
            'staff_name' => $staff_name,
            'staff_email' => $staff_email,
            'staff_phone' => $staff_phone,
            'staff_dob' => $staff_dob,
            'staff_password' => $staff_password,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM: edits the staff info
    public function getStaffInformationEdit($id): JsonResponse
    {
        $staff=StaffInformation::where('staff_id','=','$id')->first();
        return response()->json([
            'staffinformation' => $staffinformation,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function patchUpdate(Request $request, $id): JsonResponse
    {
        return response()->json([
            '' => ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM: deletes the staff data
    public function deleteStaffInformation($id): JsonResponse
    {
        $staff=StaffInformation::where('staff_id','=','$id')->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
