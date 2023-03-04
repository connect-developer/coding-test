<?php

namespace App\Http\Middleware;

use App\Core\Response\MetaResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminCompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('path') !== 'admin' &&
            $request->route('path') !== 'company') {
            $meta = (array) new MetaResponse('ERROR',
                Response::HTTP_NOT_FOUND);

            return response()->json([
                "meta" => $meta,
                "message" => "Not found"
            ], Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
