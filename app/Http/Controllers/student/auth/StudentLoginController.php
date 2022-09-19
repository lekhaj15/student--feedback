<?php

namespace App\Http\Controllers\student\auth;

use App\Http\Controllers\Controller;
use App\Models\admin\Auth\Admin;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class StudentLoginController extends Controller
{

    // SUM: verify login credentials and jwt response
    public function postStudentLogin(Request $request): JsonResponse
    {
//        $request->validate([
//            'email' => ['required', 'string', 'email', 'max:255'],
//            'password' => ['required', 'string', 'min:4'],
//        ]);

        $student_email = $request->input('student_email');
        $student_password = $request->input('student_password');
        $remember_token = $request->input('remember_token');

        $student = StudentInformation::select(['id', 'student_email', 'student_password'])
            ->where('email', '=', $student_email)->first();

        if (is_null($student)) {
            return response()->json(['errors' => 'invalid email'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $is_password_matched = Hash::check($student_password, $student->password);
        if ($is_password_matched == false) {
            return response()->json(['errors' => 'invalid password'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = auth('student')->setTTL(43200)->login($student, false);

        return response()->json([
            'access_token' => "bearer {$token}",
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postStudentRefreshToken(Request $request): JsonResponse
    {
        $refresh_token = auth('student')->refresh();
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
    public function postAdminLogout(): JsonResponse
    {
        auth('student')->logout();
        return response()->json([
            'success' => 'successfully logged out',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
