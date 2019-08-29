<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        
        if(Auth::guard($role)->check()){
            if($role == 'users')
                return redirect('/');
            else if($role == 'admin')
                return redirect('admin/dashboard');

        }

        return $next($request);
    }
}
