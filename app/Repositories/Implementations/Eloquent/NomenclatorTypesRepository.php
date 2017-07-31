<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 16:16
 */

namespace CUBiM\Repositories\Implementations\Eloquent;

use CUBiM\Repositories\Interfaces\Eloquent\IEloquentRepository;
use CUBiM\Repositories\Interfaces\INomenclatorTypesRepository;
use Illuminate\Container\Container as App;

/**
 * Class NomenclatorTypesRepository
 * @package CUBiM\Repositories\Eloquent\Implementations
 */
class NomenclatorTypesRepository extends EloquentRepository implements INomenclatorTypesRepository, IEloquentRepository
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->setModel('CUBiM\Model\NomenclatorType');
    }
}