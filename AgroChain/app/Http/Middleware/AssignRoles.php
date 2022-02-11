<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AssignRoles
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
        if(!session('role')){
            if(Auth::user()->isAdmin == 1){
                session(['role' => 'admin']);
            }elseif(Auth::user()->isAdmin == 2) {
                session(['role' => 'riskmanager']);
            }
            elseif(Auth::user()->isAdmin == 0) {
                session(['role' => 'farmer']);
            }else{
                session(['role' => 'user']);
            }
            return $next($request);
        }
        return $next($request);
    }
}
