<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckValueInHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, Int $number, String $role_name): Response
    {
        if ($request->header("token") != "123456") {
            return response()->json(["error" => "Unauthorized " . $number . " " . $role_name], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
