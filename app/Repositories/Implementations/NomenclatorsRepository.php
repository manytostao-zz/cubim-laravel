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

/**
 * Class NomenclatorsRepository
 * @package CUBiM\Repositories\Implementations
 */
class NomenclatorsRepository implements INomenclatorsRepository
{

    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function find($id, $with = [])
    {
        return Nomenclator::with($with)->find($id);
    }

    /**
     * @param $filters
     * @param array $with
     * @param bool $countOnly
     * @param bool $queryOnly
     * @return mixed
     */
    public function findByFilters($filters, $with = [], $countOnly = false, $queryOnly = false)
    {
        return Nomenclator::with($with)->filter($filters, $countOnly, $queryOnly);
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return Nomenclator::destroy($id);
    }

    /**
     * @param $nomenclator
     */
    public function save($nomenclator)
    {
        $nomenclator->save();
    }
}