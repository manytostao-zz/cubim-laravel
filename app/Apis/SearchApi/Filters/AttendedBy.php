<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 21/05/2016
 * Time: 19:53
 */

namespace CUBiM\Apis\SearchApi\Filters;

use Illuminate\Database\Eloquent\Builder;

class AttendedBy implements Filter
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
                return $builder->where('attended_by_id', '=', $value);
            else {
                return $builder->whereNull('attended_by_id');
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
        return $builder->select('customers.*')
            ->distinct()
            ->leftJoin('users', 'users.id', '=', 'customers.attended_by_id')
            ->orderBy('users.first_name', $dir)
            ->orderBy('users.last_name', $dir);
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