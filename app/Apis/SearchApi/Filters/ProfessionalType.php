<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 21/05/2016
 * Time: 19:53
 */

namespace CUBiM\Apis\SearchApi\Filters;

use CUBiM\Model\Customer;
use Illuminate\Database\Eloquent\Builder;

class ProfessionalType implements Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder|void $builder
     * @internal param $ |Builder $builder
     */
    public static function applyWhere(Builder $builder, $value)
    {
        if (!is_null($value) && $value != '')
            if ($value != -1)
                return $builder->select('customers.*')->where(function ($builder) use ($value) {
                    $builder->whereHas('nomenclators', function ($builder) use ($value) {
                        $builder->where('id', '=', $value);
                    });
                });
            else {
                $except = Customer::select('customers.id')->where(function ($builder) use ($value) {
                    $builder->whereHas('nomenclators', function ($builder) use ($value) {
                        $builder->where('nomenclator_type_id', '=', 1);
                    });
                })->get()->toArray();
                return $builder->select('customers.*')->where(function ($builder) use ($except) {
                    $builder->whereNotIn('customers.id', $except);
                });
            }
        return $builder;
    }

    /**
     * Apply a given order to the builder instance.
     *
     * @param Builder $builder
     * @param $dir
     * @return Builder $builder
     * @internal param $column
     * @internal param mixed $value
     */
    public static function applyOrderBy(Builder $builder, $dir)
    {
        return $builder->select('customers.*')->distinct()->join('customer_nomenclators', 'id', '=', 'customer_nomenclators.customer_id')
            ->join('nomenclators', function ($join) {
                $join->on('customer_nomenclators.nomenclator_id', '=', 'nomenclators.id')
                    ->where('nomenclators.nomenclator_type_id', '=', '1');
            })
            ->orderBy('nomenclators.description', $dir);
    }

    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function applyOrWhere(Builder $builder, $value)
    {
        return $builder;
    }
}