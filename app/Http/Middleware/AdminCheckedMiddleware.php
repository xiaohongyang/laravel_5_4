<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheckedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        $auth = Auth::guard('admin');
        if($auth->check()) {
            return redirect(route('admin.home'));
        }
        return $next($request);
    }
}
