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
    public function handle($request, Closure $next, $canAccess)
    {

        /**
        * Role ID Note
        * 1 = Admin
        * 2 = Owner
        * 3 = Cashier
        */
        
        $roleToId = [
            /**
             * Owner can access all admin role
             */
            "admin" => [1, 2],

            /**
             * Only owner can access owner role
             */
            "owner" => [2],
            
            /**
             * Cashier role can accessed by admin, owner, cashier
             */
            "cashier" => [1, 2, 3]
        
        ];

        /**
         * Get the login user role ID
         */
        $user_role = Auth()->user()->role_id;
        dd($user_role);
        if (in_array($user_role, $roleToId[$canAccess])) {
            return $next($request);
        }

        return redirect()->route('landing-page');
    }
}
