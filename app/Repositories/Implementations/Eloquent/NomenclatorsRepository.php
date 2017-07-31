<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 14:08
 */

namespace CUBiM\Repositories\Implementations\Eloquent;

use CUBiM\Repositories\Interfaces\Eloquent\IEloquentRepository;
use CUBiM\Repositories\Interfaces\INomenclatorsRepository;
use Illuminate\Container\Container as App;

/**
 * Class NomenclatorsRepository
 * @package CUBiM\Repositories\Eloquent\Implementations
 */
class NomenclatorsRepository extends EloquentRepository implements INomenclatorsRepository, IEloquentRepository
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->setModel('CUBiM\Model\Nomenclator');
    }
}