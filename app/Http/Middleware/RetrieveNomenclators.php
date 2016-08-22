<?php
/**
 * Created by PhpStorm.
 * User: osmany.torres
 * Date: 5/27/2016
 * Time: 11:59 AM
 */

namespace CUBiM\Http\Middleware;

use Closure;
use CUBiM\Model\NomenclatorType;

class RetrieveNomenclators
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nomenclator_types = NomenclatorType::orderBy('description')->get();

        $request->attributes->add(['nomenclator_types' => $nomenclator_types]);

        return $next($request);
    }
}