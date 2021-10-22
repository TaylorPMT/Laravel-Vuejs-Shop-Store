<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;

class Admin  extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->bearerToken();

        $guardDefaults =  [
            'web',
            'api'
        ];
        foreach ($guards as $index => $guard) {
            if (!in_array($guard, $guardDefaults)) {
                array_push($relations, $guard);
                unset($guards[$index]);
            }
        }

        // $this->authenticate($request, $guards);
         return $next($request);
    }
}
