<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 30/07/2017
 * Time: 14:24
 */

namespace CUBiM\Repositories\Interfaces\Eloquent;

use CUBiM\Repositories\IRepository;

/**
 * Interface IEloquentRepository
 * @package CUBiM\Repositories\Eloquent
 */
interface IEloquentRepository extends IRepository
{
    /**
     * @param $eloquentModel
     * @return mixed
     */
    public function setModel($eloquentModel);

    /**
     * @param array $relations
     * @return mixed
     */
    public function with(array $relations);
}