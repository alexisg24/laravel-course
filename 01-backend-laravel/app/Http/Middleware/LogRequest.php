<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = [
            "url" => $request->url(),
            "ip" => $request->ip(),
            "method" => $request->method(),
            "headers" => $request->headers->all(),
            "body" => $request->all()
        ];

        Log::info("Request: ", $data);
        return $next($request);
    }

    public function terminate(Request $request, Response $response)
    {
        Log::info("Response: ", [
            "status" => $response->getStatusCode(),
            "content" => $response->getContent()
        ]);
    }
}
