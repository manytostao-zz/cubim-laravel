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
    public static function applyFilters($filters, &$query)
    {
        $query = static::applyDecoratorFromRequest($filters, $query);
    }

    public static function applyDecoratorFromRequest($filters, &$query)
    {
        foreach ($filters['filters'] as $key => $value) {
            $decorator = static::createFilterDecorator($key);

            if (static::isValidDecorator($decorator))
                $query = $decorator::applyWhere($query, $value);
        }
        foreach ($filters['order'] as $key => $value) {
            $decorator = static::createFilterDecorator($filters['columns'][$value['column']]['name']);

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