<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 14:05
 */

namespace CUBiM\Repositories\Interfaces;


interface INomenclatorsRepository
{
    public function find($id);

    public function countByNomenclatorTypeId($nomenclatorTypeId);

    public function findByFilters($filters, $countOnly = false);

    public function delete($id);

    public function save($nomenclator);
}