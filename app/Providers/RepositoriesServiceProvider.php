<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 25/06/2017
 * Time: 14:11
 */

namespace CUBiM\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CUBiM\Repositories\Interfaces\INomenclatorsRepository', 'CUBiM\Repositories\Implementations\NomenclatorsRepository');
        $this->app->bind('CUBiM\Repositories\Interfaces\INomenclatorTypesRepository', 'CUBiM\Repositories\Implementations\NomenclatorTypesRepository');
    }
}