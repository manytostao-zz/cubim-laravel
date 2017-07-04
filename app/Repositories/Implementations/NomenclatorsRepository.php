<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 14:08
 */

namespace CUBiM\Repositories\Implementations;

use CUBiM\Model\Nomenclator;
use CUBiM\Repositories\Interfaces\INomenclatorsRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class NomenclatorsRepository
 * @package CUBiM\Repositories\Implementations
 */
class NomenclatorsRepository implements INomenclatorsRepository
{

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Nomenclator::find($id);
    }

    public function countByNomenclatorTypeId($nomenclatorTypeId)
    {
        return Nomenclator::where('nomenclator_type_id', $nomenclatorTypeId)->count();
    }

    public function findByFilters($filters, $countOnly = false)
    {
        return Nomenclator::filter($filters, $countOnly);
    }

    public function delete($id)
    {
        return Nomenclator::destroy($id);
    }

    public function save($nomenclator)
    {
        $nomenclator->save();
    }
}