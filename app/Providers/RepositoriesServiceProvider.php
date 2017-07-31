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
        $this->app->bind('CUBiM\Repositories\Interfaces\INomenclatorsRepository', 'CUBiM\Repositories\Implementations\Eloquent\NomenclatorsRepository');
        $this->app->bind('CUBiM\Repositories\Interfaces\INomenclatorTypesRepository', 'CUBiM\Repositories\Implementations\Eloquent\NomenclatorTypesRepository');
        $this->app->bind('CUBiM\Repositories\Interfaces\ICustomersRepository', 'CUBiM\Repositories\Implementations\Eloquent\CustomersRepository');
        $this->app->bind('CUBiM\Repositories\Interfaces\ITracesRepository', 'CUBiM\Repositories\Implementations\Eloquent\TracesRepository');
    }
}