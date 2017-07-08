<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 16:16
 */

namespace CUBiM\Repositories\Implementations;


use CUBiM\Repositories\Interfaces\INomenclatorTypesRepository;
use CUBiM\Model\NomenclatorType;

/**
 * Class NomenclatorTypesRepository
 * @package CUBiM\Repositories\Implementations
 */
class NomenclatorTypesRepository implements INomenclatorTypesRepository
{

    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function find($id, $with = [])
    {
        return NomenclatorType::with($with)->find($id);
    }
}