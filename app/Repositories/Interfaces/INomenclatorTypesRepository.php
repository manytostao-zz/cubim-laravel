<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 16:15
 */

namespace CUBiM\Repositories\Interfaces;


/**
 * Interface INomenclatorTypesRepository
 * @package CUBiM\Repositories\Interfaces
 */
interface INomenclatorTypesRepository
{
    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function find($id, $with = []);
}