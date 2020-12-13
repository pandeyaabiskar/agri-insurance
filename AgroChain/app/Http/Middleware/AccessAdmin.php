<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;


class AccessAdmin
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
        if(Auth::user()->isAdmin == 1) {
            return $next($request);
        }
        else {
            Session::flash('message', 'Sorry, You are authorized to view the requested page!!');
            Session::flash('class', 'danger');
            return redirect('/');
        }
    }
}
