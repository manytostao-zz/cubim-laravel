<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 16:15
 */

namespace CUBiM\Repositories\Interfaces;


/**
 * Interface ITracesRepository
 * @package CUBiM\Repositories\Interfaces
 */
interface ITracesRepository
{

    /**
     * @param $filters
     * @param array $with
     * @param bool $countOnly
     * @param bool $queryOnly
     * @return mixed
     * @internal param array $whith
     */
    public function findByFilters($filters, $with = [], $countOnly = false, $queryOnly = false);
}