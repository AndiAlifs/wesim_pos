<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $user)
    {
        $user_role = Auth()->user()->role_id;
        if (in_array($user_role, [1,2])) {
            return $next($request);
        }

        return redirect()->route('landing-page');
    }
}
