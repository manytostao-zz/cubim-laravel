<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 05/08/2017
 * Time: 16:41
 */

namespace CUBiM\Repositories\Implementations\Eloquent;


use CUBiM\Repositories\Interfaces\Eloquent\IEloquentRepository;
use CUBiM\Repositories\Interfaces\IRolesRepository;
use Illuminate\Container\Container as App;

class RolesRepository extends EloquentRepository implements IRolesRepository, IEloquentRepository
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->setModel('CUBiM\Model\Rol');
    }
}