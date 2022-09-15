<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\admin\Auth\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginController extends Controller
{
    // URI: /
    // SUM: verify login credentials and jwt response
    public function postAdminLogin(Request $request): JsonResponse
    {
//        $request->validate([
//            'email' => ['required', 'string', 'email', 'max:255'],
//            'password' => ['required', 'string', 'min:4'],
//        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember_token = $request->input('remember_token');

        $admin = Admin::select(['id', 'email', 'password'])
            ->where('email', '=', $email)->first();

        if (is_null($admin)) {
            return response()->json(['errors' => 'invalid email'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $is_password_matched = Hash::check($password, $admin->password);
        if ($is_password_matched == false) {
            return response()->json(['errors' => 'invalid password'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = auth('admin')->setTTL(43200)->login($admin, false);

        return response()->json([
            'access_token' => "bearer {$token}",
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postAdminRefreshToken(Request $request): JsonResponse
    {
        $refresh_token = auth('admin')->refresh();
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

        // URI: /
        // SUM:
        public function postAdminLogout(): JsonResponse
        {
            auth('admin')->logout();
            return response()->json([
                'success' => 'successfully logged out',
            ], JsonResponse::HTTP_NO_CONTENT);
        }
    }

