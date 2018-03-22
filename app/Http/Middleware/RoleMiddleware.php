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
    public function handle($request, Closure $next)
    {
        $action=$request->route()->getAction();
        $roles=isset($action['role']) ? $action['role']:null;

        if($request->user()->hasManyRole($roles) || !$roles)
        {
            return $next($request);
        }

        return response(view('error'));
//        return response('You are unauthorized.');
    }
}
