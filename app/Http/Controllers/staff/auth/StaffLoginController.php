<?php

namespace App\Http\Controllers\staff\auth;

use App\Http\Controllers\Controller;

use App\Models\institute\staff\StaffInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class StaffLoginController extends  Controller
{



 public function postStaffLogin(Request $request): JsonResponse
{
//        $request->validate([
//            'email' => ['required', 'string', 'email', 'max:255'],
//            'password' => ['required', 'string', 'min:4'],
//        ]);

    $staff_email = $request->input('staff_email');
    $staff_password = $request->input('staff_password');
    $remember_token = $request->input('remember_token');

    $staff = StaffInformation::select(['id', 'staff_email', 'staff_password'])
        ->where('staff_email', '=', $staff_email)->first();

    if (is_null($staff)) {
        return response()->json(['errors' => 'invalid email'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $is_password_matched = Hash::check($staff_password, $staff->staff_password);
    if ($is_password_matched == false) {
        return response()->json(['errors' => 'invalid password'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    $token = auth('staff')->setTTL(43200)->login($staff, false);

    return response()->json([
        'access_token' => "bearer {$token}",
    ], JsonResponse::HTTP_OK);
}

    // URI: /
    // SUM:
    public function postStaffRefreshToken(Request $request): JsonResponse
{
    $refresh_token = auth('staff')->refresh();
    return response()->json([
        'refresh_token' => "bearer {$refresh_token}",
    ], JsonResponse::HTTP_CREATED);
}


    // URI: /
    // SUM:
    public function postAdminEmailVerify(Request $request): JsonResponse
{
    $request->validate([
        'id' => 'required|integer',
        'hash' => sprintf("required|regex:/%s/", validateMd5()),
    ]);

    $auth_id = (int)$request->input('id');
    $hash = (string)$request->input('hash');

    $check_email_hash_admin = AuthEmailVerification::where([
        ['auth_id', '=', $auth_id],
        ['auth_type', '=', 'student'],
        ['email_hash', '=', $hash],
        ['is_email_verified', '=', 0],
    ])->first();

    if (is_null($check_email_hash_admin)) {
        return response()->json(['errors' => 'email already verified'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    $check_email_hash_admin->update(['email_hash' => null, 'is_email_verified' => 1]);

    return response()->json(['success' => 'email verified'], JsonResponse::HTTP_ACCEPTED);
}

    // URI: /
    // SUM:
    public function postStaffLogout(): JsonResponse
{
    auth('staff')->logout();
    return response()->json([
        'success' => 'successfully logged out',
    ], JsonResponse::HTTP_NO_CONTENT);
}
}
