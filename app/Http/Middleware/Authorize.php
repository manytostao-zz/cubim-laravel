<?php

namespace CUBiM\Http\Middleware;

use Closure;

/**
 * Class Authorize
 * @package CUBiM\Http\Middleware
 */
class Authorize
{
    /**
     * @var array
     */
    private $unrestricted_routes = ['auth.login', 'auth.logout'];
    
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

        if ((array_search($action, $this->unrestricted_routes) === false) and !(\Sentinel::hasAccess($action))) {
            return \Redirect::route('error.503')->setStatusCode(401, 'Acceso denegado');
        }
        
        return $next($request);
    }
}
