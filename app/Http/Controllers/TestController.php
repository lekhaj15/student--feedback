<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getBannerIndex(Request $request): JsonResponse
    {
        $banners = User::toBase()
//            ->where(['banner_status' => 'enabled'])
            ->get();

        return response()->json([
            'banners' => $banners,
        ], JsonResponse::HTTP_OK);
    }
}
