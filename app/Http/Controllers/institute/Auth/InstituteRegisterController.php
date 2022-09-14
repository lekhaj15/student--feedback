<?php

namespace App\Http\Controllers\institute\Auth;

use App\Http\Controllers\Controller;
use App\Models\institute\Auth\Institute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class InstituteRegisterController extends Controller
{
    // URI: /institute/auth/register
    // SUM: register new institute
    public function postInstituteRegister(Request $request): JsonResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:institutes'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        $name = e($request->input('name'));
        $email = $request->input('email');
        $password = $request->input('password');

        $institute = Institute::create([
            'full_name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);


        return response()->json(['success' => 'please verify your email'], JsonResponse::HTTP_CREATED);
    }
}
