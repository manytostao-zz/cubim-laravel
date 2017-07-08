<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 14:05
 */

namespace CUBiM\Repositories\Interfaces;

/**
 * Interface ICustomersRepository
 * @package CUBiM\Repositories\Interfaces
 */
interface ICustomersRepository
{
    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function findById($id, $with = []);

    /**
     * @param $filters
     * @param array $with
     * @param bool $countOnly
     * @param bool $queryOnly
     * @return mixed
     * @internal param array $whith
     */
    public function findByFilters($filters, $with = [], $countOnly = false, $queryOnly = false);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $customer
     * @param array $fields
     * @return mixed
     */
    public function update($customer, $fields=[]);

    /**
     * @param $customer
     * @return mixed
     */
    public function save($customer);

    /**
     * @param $customer
     * @param $nomenclators
     * @return mixed
     */
    public function syncNomenclators($customer, $nomenclators);

    /**
     * @param $customerType
     * @return mixed
     */
    public function getLastAssignedLibraryCardNumber($customerType);
}