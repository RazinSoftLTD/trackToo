<?php

namespace Modules\Payroll\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PayrollAuthCheck
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $permission = $user->permission('enter_payroll');
        if($permission == 'none' || !$permission) {
            $currentRoute = $request->route()->getName();
            $key = $request->cookie('payroll_auth_key');
            if(!$key && $user->password != $key) {
                $route = encrypt($currentRoute);
                return to_route('payroll.pass_auth_key', ['path' => $route]);
            }
        }

        return $next($request);
    }
}
