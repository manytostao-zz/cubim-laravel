<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 14:08
 */

namespace CUBiM\Repositories\Implementations;

use CUBiM\Model\Customer;
use CUBiM\Repositories\Interfaces\ICustomersRepository;

/**
 * Class NomenclatorsRepository
 * @package CUBiM\Repositories\Implementations
 */
class CustomersRepository implements ICustomersRepository
{

    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function findById($id, $with = [])
    {
        return Customer::with($with)->find($id);
    }

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
        return Customer::with($with)->filter($filters, $countOnly, $queryOnly);
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return Customer::destroy($id);
    }

    /**
     * @param $customer
     * @param array $fields
     * @return mixed
     */
    public function update($customer, $fields = [])
    {
        $customer->update($fields);
    }

    /**
     * @param $customer
     * @return mixed|void
     */
    public function save($customer)
    {
        $customer->save();
    }

    /**
     * @param $customer
     * @param $nomenclators
     * @return mixed|void
     */
    public function syncNomenclators($customer, $nomenclators)
    {
        $customer->nomenclators()->sync($nomenclators);
    }

    /**
     * @param $customerType
     * @return mixed
     */
    public function getLastAssignedLibraryCardNumber($customerType)
    {
        return Customer::where(function ($query) use (&$customerType) {
            $query->whereHas('nomenclators', function ($query) use (&$customerType) {
                $query->where('nomenclators.id', '=', '' . $customerType . '');
            });
        })->max('customers.library_card');
    }
}