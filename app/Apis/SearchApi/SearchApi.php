<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 03/07/2017
 * Time: 19:52
 */

namespace CUBiM\Apis\SearchApi;


class SearchApi
{
    public static function applyFilters($filters, $orderBy, $columns, &$query)
    {
        $query = static::applyDecoratorFromRequest($filters, $orderBy, $columns, $query);
    }

    public static function applyDecoratorFromRequest($filters, $orderBy, $columns, &$query)
    {
        if (isset($filters))
            foreach ($filters as $key => $value) {
                $decorator = static::createFilterDecorator($key);

                if (static::isValidDecorator($decorator))
                    $query = $decorator::applyWhere($query, $value);
            }
        if (isset($orderBy))
            foreach ($orderBy as $key => $value) {
                $decorator = static::createFilterDecorator($columns[$value['column']]['name']);

                if (static::isValidDecorator($decorator))
                    $query = $decorator::applyOrderBy($query, $value['dir']);
            }

        return $query;
    }

    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . str_replace(' ', '', ucwords(str_replace('_', '', $name)));
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}