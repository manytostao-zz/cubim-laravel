<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 07/07/2017
 * Time: 21:46
 */

namespace CUBiM\Helpers;

use Illuminate\Http\Request;

/**
 * Class DataTableHelper
 * @package CUBiM\Helpers
 */
class DataTableHelper
{
    /**
     * @param Request $request
     * @param $sessionFiltersName
     * @return mixed
     */
    public static function extractRequestFilters(Request $request, $sessionFiltersName)
    {

        $filters['search'] = $request->get('search');
        $filters['order'] = $request->get('order');
        $filters['length'] = $request->get('length');
        $filters['start'] = $request->get('start');
        $filters['columns'] = $request->get('columns');
        $filters['filters'] = $request->session()->has($sessionFiltersName) ? $request->session()->get($sessionFiltersName) : array();

        return $filters;
    }

    /**
     * @param $customer
     * @param $nomenclatorId
     * @return string
     */
    public static function getCustomerNomenclator($customer, $nomenclatorId)
    {
        $nom = $customer->nomenclators->filter(
            function ($nomenclator) use ($nomenclatorId) {
                return $nomenclator->nomenclator_type_id == $nomenclatorId;
            });
        return count($nom) > 0 ? $nom->first()->description : '';
    }
}