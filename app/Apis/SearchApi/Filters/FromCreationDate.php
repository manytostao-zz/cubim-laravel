<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 21/05/2016
 * Time: 19:53
 */

namespace CUBiM\Apis\SearchApi\Filters;


use Illuminate\Database\Eloquent\Builder;

class FromCreationDate implements Filter
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
            $from = new \DateTime('today', new \DateTimeZone('America/Havana'));
            $from_creation_date = explode('/', $value);
            $from->setDate($from_creation_date[2], $from_creation_date[1], $from_creation_date[0]);
            $builder->where('created_at', '>=', $from);
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