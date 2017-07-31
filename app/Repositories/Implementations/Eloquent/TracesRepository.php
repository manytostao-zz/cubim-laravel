<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 08/07/2017
 * Time: 15:13
 */

namespace CUBiM\Repositories\Implementations\Eloquent;


use CUBiM\Repositories\Interfaces\Eloquent\IEloquentRepository;
use CUBiM\Repositories\Interfaces\ITracesRepository;
use Illuminate\Container\Container as App;

class TracesRepository extends EloquentRepository implements ITracesRepository, IEloquentRepository
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->setModel('CUBiM\Model\Trace');
    }
}