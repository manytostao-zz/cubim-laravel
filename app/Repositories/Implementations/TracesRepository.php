<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 08/07/2017
 * Time: 15:13
 */

namespace CUBiM\Repositories\Implementations;


use CUBiM\Model\Trace;
use CUBiM\Repositories\Interfaces\ITracesRepository;

class TracesRepository implements ITracesRepository
{

    /**
     * @param $filters
     * @param array $with
     * @param bool $countOnly
     * @param bool $queryOnly
     * @return mixed
     * @internal param array $whith
     */
    public function findByFilters($filters, $with = [], $countOnly = false, $queryOnly = false)
    {
        Trace::with($with)->filter($filters, $countOnly, $queryOnly);
    }
}