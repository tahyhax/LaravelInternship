<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class VerifyRouteAccess
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->user()->cannot('access-route', $request->route()->getName())) {
            throw new AuthorizationException(
                __('You are not authorized to perform this action')
            );
        }

        return $next($request);
    }
}
