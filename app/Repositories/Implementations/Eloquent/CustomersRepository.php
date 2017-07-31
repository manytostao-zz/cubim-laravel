<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 14:08
 */

namespace CUBiM\Repositories\Implementations\Eloquent;

use CUBiM\Repositories\Interfaces\Eloquent\IEloquentRepository;
use CUBiM\Repositories\Interfaces\ICustomersRepository;
use Illuminate\Container\Container as App;

/**
 * Class NomenclatorsRepository
 * @package CUBiM\Repositories\Eloquent\Implementations
 */
class CustomersRepository extends EloquentRepository implements ICustomersRepository, IEloquentRepository
{
    /**
     * CustomersRepository constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->setModel('CUBiM\Model\Customer');
    }

    public function update(array $data, $id, $attribute = "id")
    {
        if (parent::update($data, $id, $attribute))
            return $this->model->push();
        else return false;
    }

    /**
     * @param $id
     * @param $nomenclators
     * @return mixed|void
     */
    public function syncNomenclators($id, $nomenclators)
    {
        $customer = $this->find($id);
        $customer->nomenclators()->sync($nomenclators);
    }
}