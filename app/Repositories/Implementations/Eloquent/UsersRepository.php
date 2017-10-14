<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 05/08/2017
 * Time: 16:56
 */

namespace CUBiM\Repositories\Implementations\Eloquent;


use CUBiM\Repositories\Interfaces\Eloquent\IEloquentRepository;
use CUBiM\Repositories\Interfaces\IUsersRepository;
use Illuminate\Container\Container as App;

class UsersRepository extends EloquentRepository implements IUsersRepository, IEloquentRepository
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->setModel('CUBiM\Model\User');
    }
}