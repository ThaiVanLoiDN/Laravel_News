<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $role)
    {
        $arUser = Auth::user();
        $capbac = $arUser['capbac'];

        if($role == 'admin' && ($capbac != 4 && $capbac != 1))
        {
            return redirect()->route('admin.index.index');
        }

        if($role == 'smod' && ($capbac != 4 && $capbac != 3 && $capbac != 1))
        {
            return redirect()->route('admin.index.index');
        }


        return $next($request);
    }
}
