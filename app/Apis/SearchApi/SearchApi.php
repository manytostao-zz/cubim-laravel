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
        if (isset($filters['criterias']))
            foreach ($filters['criterias'] as $key => $value) {
                $decorator = static::createFilterDecorator($key);

                if (static::isValidDecorator($decorator))
                    $query = $decorator::applyWhere($query, $value);
            }
        if (isset($filters['order']))
            foreach ($filters['order'] as $key => $value) {
                $decorator = static::createFilterDecorator($key);

                if (static::isValidDecorator($decorator))
                    $query = $decorator::applyOrderBy($query, $value);
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