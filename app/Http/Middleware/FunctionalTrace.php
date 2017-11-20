<?php

namespace CUBiM\Http\Middleware;

use Closure;
use CUBiM\Model\Trace;
use Route;
use Sentinel;

/**
 * Class FunctionalTrace
 * @package CUBiM\Http\Middleware
 */
class FunctionalTrace
{
    protected $comment;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @internal param string $comment
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {
        $this->end = microtime(true);

        $this->trace($request);
    }

    /**
     * @param $request
     */
    protected function trace($request)
    {
        $route = Route::getRoutes()->match($request);
        $action = $route->getName();
        $user = Sentinel::getUser(true);
        if ($user !== null
            && (str_contains($action, ['store', 'update', 'destroy', 'ban', 'activate', 'change_password']))
            && $request->session()->get('errors') === null
        ) {

            $translate = explode('.', $action);

            $trace = new Trace(
                array(
                    'operation' => trans('operations.' . $translate[1], [], '', 'es'),
                    'object' => trans($translate[0] . '.object', [], '', 'es'),
                    'comments' => $request->session()->pull('traceComments'),
                    'module' => trans($translate[0] . '.module', [], '', 'es'),
                    'user_id' => $user->getUserId())
            );
            $trace->save();
        }

        $log = ['ip' => $request->ip(), 'action' => $action, 'user' => $user != null ? $user->getUserLogin() : 'null'];
        \Log::info($log);
    }
}
