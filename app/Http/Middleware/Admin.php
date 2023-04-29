<?php

namespace App\Http\Middleware;

use App\Helper\AuthHelper;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roleName = auth()->user()->role->name;
        if ($roleName == 'Admin'){
            return $next($request);
        }
        return redirect(AuthHelper::redirectTo($roleName));
    }
}
