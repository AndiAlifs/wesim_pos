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
        if (!Auth()->user()) {
            return redirect()->route('login');
        }

        /**
        * Role ID Note
        * 1 = Admin
        * 2 = Owner
        * 3 = Cashier
        */
        
        $roleToId = [
            /**
             * admin role_id is 1
             */
            "admin" => [1],

            /**
             * owner role_id is 2
             */
            "owner" => [2],
            
            /**
             * Can accessed by admin and owner
             */
            "admin_owner" => [1, 2],
            
            /**
             * Cashier role can accessed by admin, owner, cashier
             */
            "cashier" => [1, 2, 3, 4],
            
            /**
             * Cashier role can accessed by admin, owner, cashier
             */
            "apoteker" => [4],
        ];

        /**
         * Get the login user role ID
         */
        $user_role = Auth()->user()->role_id;
        if (in_array($user_role, $roleToId[$canAccess])) {
            return $next($request);
        }

        if(in_array($user_role, $roleToId['admin']) || in_array($user_role, $roleToId['owner'])) {
            return redirect()->route('home');
        }

        if(in_array($user_role, $roleToId['cashier'])) {
            return redirect()->route('cashier');
        }
        return redirect()->route('landing-page');
    }
}
