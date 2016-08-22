<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 21/05/2016
 * Time: 19:53
 */

namespace CUBiM\Apis\NomenclatorSearch\Filters;

use CUBiM\Model\Customer;
use Illuminate\Database\Eloquent\Builder;

class NomenclatorType implements Filter
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

        if (!is_null($value) and $value != '')
            return $builder->where('nomenclator_type_id', '=', $value);
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
        return $builder->select('nomenclators.*')->distinct()->join('nomenclator_types', 'nomenclator_type_id', '=', 'nomenclator_types.id')
            ->orderBy('nomenclator_types.description', $dir);
    }
}