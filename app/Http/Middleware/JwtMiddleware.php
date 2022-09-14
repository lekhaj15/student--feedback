<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;



class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
//            dump(auth('admin')->check());
//            dump(auth('contractor')->check());
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['client_error' => 'user not found'], JsonResponse::HTTP_NOT_FOUND);
            }
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['client_error' => 'token is invalid'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['client_error' => 'token is expired'], JsonResponse::HTTP_GONE);
//                try {
//                    dump('-------------------------');
//                    dump($request->headers->get('Authorization'));
////                    $refreshed = JWTAuth::setToken($request->headers->get('Authorization'));
////                    dump($refreshed);
//                    $ggg = JWTAuth::refresh();
//                    $user = JWTAuth::setToken($ggg)->toUser();
//                    $request->headers->set('Authorization', 'Bearer ' . $ggg);
//                } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e) {
////                    return $next($request);
//                    return response()->json(['client_error' => 'Token cannot be refreshed'], JsonResponse::HTTP_UNAUTHORIZED);
//                }
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['client_error' => 'authorization token not found'], JsonResponse::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
