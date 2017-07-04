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

class NomenclatorTypesRepository implements INomenclatorTypesRepository
{

    public function find($id)
    {
        return NomenclatorType::find($id);
    }
}