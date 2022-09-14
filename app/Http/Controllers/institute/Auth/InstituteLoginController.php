<?php

namespace App\Http\Controllers\institute\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Auth\Admin;
use App\Models\institute\Auth\Institute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstituteLoginController extends Controller
{
    // URI: /api/Institute/auth/login
    // SUM: verify login credentials and jwt response
    public function postInstituteLogin(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember_token = $request->input('remember_token');

        $institute = Institute::select(['id', 'email', 'password'])
            ->where('email', '=', $email)->first();

        if (is_null($institute)) {
            return response()->json(['errors' => 'invalid email'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $is_password_matched = Hash::check($password, $institute->password);
        if ($is_password_matched == false) {
            return response()->json(['errors' => 'invalid password'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = auth('institute')->setTTL(43200)->login($institute, false);

        return response()->json([
            'access_token' => "bearer {$token}",
//            'expires_in' => auth()->factory()->getTTL() * 60
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/Institute/auth/refresh
    // SUM: refresh token
    public function postAdminRefreshToken(Request $request): JsonResponse
    {
        $refresh_token = auth('admin')->refresh();
        return response()->json([
            'refresh_token' => "bearer {$refresh_token}",
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/Institute/auth/login/verify
    // SUM: verify email by auth_id, email_hash
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
            ['auth_type', '=', 'admin'],
            ['email_hash', '=', $hash],
            ['is_email_verified', '=', 0],
        ])->first();

        if (is_null($check_email_hash_admin)) {
            return response()->json(['errors' => 'email already verified'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $check_email_hash_admin->update(['email_hash' => null, 'is_email_verified' => 1]);

        return response()->json(['success' => 'email verified'], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/Institute/auth/logout
    // SUM: logout
    public function postInstituteLogout(): JsonResponse
    {
        auth('institute')->logout();
        return response()->json(['success' => 'successfully logged out'], JsonResponse::HTTP_OK);
    }
}
