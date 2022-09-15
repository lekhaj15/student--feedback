<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;

use App\Models\admin\Auth\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminRegisterController extends Controller
{
    // URI: /
    // SUM: register new admin
    public function postAdminRegister(Request $request): JsonResponse
    {
//        $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:admin'],
//            'password' => ['required', 'string', 'min:4'],
//        ]);

        $name = e($request->input('name'));
        $email = $request->input('email');
        $password = $request->input('password');

        Admin::create([
            'full_name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return response()->json(['success' => 'please verify your email'], Response::HTTP_CREATED);
    }
}

