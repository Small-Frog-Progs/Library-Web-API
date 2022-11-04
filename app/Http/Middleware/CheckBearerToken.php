<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->token && User::where('remember_token', $request->token)->first()) {
//        if ($request->bearerToken() && User::where('remember_token', $request->bearerToken())->first()) {
            return $next($request);
        } else {
            return response()->json([
                'Bearer' => 'error',
            ], 401);
        }
    }
}
