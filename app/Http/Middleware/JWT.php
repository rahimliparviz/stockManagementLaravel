<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\facades\JWTAuth;

class JWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if( !$user ) throw new Exception('User Not Found');
        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json([
                        'data' => null,
                        'status' => false,
                        'err_' => [
                            'message' => 'Token Invalid',
                            'code' => 1
                        ]
                    ]
                );
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json([
                        'data' => null,
                        'status' => false,
                        'err_' => [
                            'message' => 'Token Expired',
                            'code' =>1
                        ]
                    ]
                );
            }
            else{
                if( $e->getMessage() === 'User Not Found') {
                    return response()->json([
                            "data" => null,
                            "status" => false,
                            "err_" => [
                                "message" => "User Not Found",
                                "code" => 1
                            ]
                        ]
                    ); }
                return response()->json([
                        'data' => null,
                        'status' => false,
                        'err_' => [
                            'message' => 'Authorization Token not found',
                            'code' =>1
                        ]
                    ]
                );
            }
        }
        return $next($request);
    }

//        JWTAuth::parseToken()->authenticate();
//        return $next($request);
//    }
}
