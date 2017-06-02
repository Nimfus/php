<?php
namespace App\Http\Middleware;

use Closure;

class SanitizeMiddleware
{
    public function handle($request, Closure $next)
    {
        foreach ($request->input() as $key => $value) {
            if (empty($value)) {
                $request->request->set($key, null);
            }
        }

        return $next($request);
    }
}