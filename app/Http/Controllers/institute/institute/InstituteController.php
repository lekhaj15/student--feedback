<?php

namespace App\Http\Controllers\institute\institute;

use App\Http\Controllers\Controller;
use App\Models\institute\Auth\Institute;
use App\Models\institute\grade\GradeCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstituteController extends Controller
{
    // URI: /
    // SUM:
    public function getIndex(Request $request): JsonResponse
    {
        $institute=Institute::toBase()
        ->orderBy('id',)
        ->paginate(15);

        return response()->json([
            'institute' => $institute,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function getInstitute(Request $request): JsonResponse
    {
        $institutes= Institute::toBase()
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'institutes' => $institutes,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postStore(Request $request): JsonResponse
    {
       $full_name = $request->input('full_name');
       $email = $request->input('email');
       $role = $request->input('role');
       $password = $request->input('password');


        $institute =Institute::create([
            'full_name' => $full_name,
            'email' => $email,
            'role' => $role,
            'password' =>Hash::make("password")
        ]);
        return response()->json([
            'institute' => $institute,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getShow($id): JsonResponse
    {
        $institute= Institute::where('id', '=',$id)
            ->first();

        return response()->json([
            'institute' => $institute,



        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function patchUpdate(Request $request, $id): JsonResponse
    {
        $full_name = $request->input('full_name');
        $email= $request->input('email');
//        dd($category_name);
        $test=Institute::toBase()
            ->where([
                ['id','=',$id],
            ])

            ->update([
                'full_name'=> $full_name,
                'email' => $email
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deleteDestroy($id): JsonResponse
    {
        $institute=Institute::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
