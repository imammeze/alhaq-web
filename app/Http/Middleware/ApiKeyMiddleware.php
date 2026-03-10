<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');

        if ($apiKey !== env('API_KEY')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid or missing API Key.'
            ], 401);
        }
        
        return $next($request);
    }
}