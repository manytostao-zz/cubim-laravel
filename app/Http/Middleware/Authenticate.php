<?php

namespace CUBiM\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class Authenticate
 * @package CUBiM\Http\Middleware
 */
class Authenticate
{
    /**
     * @var array
     */
    private $unrestricted_routes = ['auth.login'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = \Route::getRoutes()->match($request);
        $action = $route->getName();

        if ((array_search($action, $this->unrestricted_routes) === false) and !($user = \Sentinel::check())) {
            return \Redirect::route('auth.login');
        }

        return $next($request);
    }
}
