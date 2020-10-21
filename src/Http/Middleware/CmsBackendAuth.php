<?php

namespace App\Http\Middleware;

use Closure;

class CmsBackendAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session('backendUser') == null ){
            
            session()->flash('error', "Signin First");
            return redirect(config('cms-backend-auth.prefix').'/login');
        }
        return $next($request);
    }
}
