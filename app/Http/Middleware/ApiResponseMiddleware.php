<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $isSuccessfulStatus = $response->status() >= 200 && $response->status() < 300;

        if ($isSuccessfulStatus) {
            $data = $response->getData(true);
            $formated = array_merge([
                'success' => true,
            ],$data);
            return response()->json($formated, $response->status());
        }
        return $response;
    }
}
