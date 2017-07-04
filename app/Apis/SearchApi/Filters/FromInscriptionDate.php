<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 21/05/2016
 * Time: 19:53
 */

namespace CUBiM\Apis\SearchApi\Filters;


use Illuminate\Database\Eloquent\Builder;

class FromInscriptionDate implements Filter
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
        if (!is_null($value) && $value != '') {
            $from = new \DateTime('today', new \DateTimeZone('America/Havana'));
            $from_inscription_date = explode('/', $value);
            $from->setDate($from_inscription_date[2], $from_inscription_date[1], $from_inscription_date[0]);
            return $builder->where('created_at', '>=', $from);
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