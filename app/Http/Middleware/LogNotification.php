<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogNotification
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        Log::info('User melakukan tindakan: ' . $request->path() . ' pada ' . now());

        return $response;
    }
}
