<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 21/05/2016
 * Time: 19:53
 */

namespace CUBiM\Apis\SearchApi\Filters;


use Illuminate\Database\Eloquent\Builder;

class ToCreationDate implements Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     * @internal param $ |Builder $builder
     */
    public static function applyWhere(Builder $builder, $value)
    {
        if (!is_null($value) && $value != '') {
            $to = new \DateTime('today', new \DateTimeZone('America/Havana'));
            $to_creation_date = explode('/', $value);
            $to->setDate($to_creation_date[2], $to_creation_date[1], $to_creation_date[0] + 1);
            $builder->where('created_at', '<=', $to);
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
        // TODO: Implement applyOrderBy() method.
    }
}