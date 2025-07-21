<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->bearerToken();
            // dd($token);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'token is missing'
                ], 401);
            }
            $employee = auth('api')->authenticate();
            // $payload = JWTAuth::parseToken()->getPayload();
            if (!$employee) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'user not found'
                ], 401);
            }
            auth()->setUser($employee);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'error',
                'message' => $err->getMessage(),
            ], 401);
        }
        // dd('finish');
        return $next($request);
    }
}
