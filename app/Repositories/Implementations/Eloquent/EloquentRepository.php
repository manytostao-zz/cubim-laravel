<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 30/07/2017
 * Time: 13:49
 */

namespace CUBiM\Repositories\Implementations\Eloquent;

use CUBiM\Apis\SearchApi\SearchApi;
use CUBiM\Exceptions\RepositoryException;
use CUBiM\Repositories\Interfaces\Eloquent\IEloquentRepository;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentRepository
 * @package CUBiM\Repositories\Eloquent
 */
class EloquentRepository implements IEloquentRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     * EloquentRepository constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @param $eloquentModel
     * @return mixed|void
     */
    public function setModel($eloquentModel)
    {
        $this->makeModel($eloquentModel);
    }

    /**
     * @param $eloquentModel
     * @throws RepositoryException
     */
    private function makeModel($eloquentModel)
    {
        $this->model = $this->app->make($eloquentModel);

        if (!$this->model instanceof Model)
            throw new RepositoryException("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
    }

    /**
     * @param array $relations
     * @return $this
     */
    public function with(array $relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * @param $id
     * @param array $relations
     */
    public function sync($id, $relations = array())
    {
        $model = $this->model->find($id);
        foreach ($relations as $relation => $values) {
            $model->$relation()->sync($values);
        }
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param int $page
     * @return mixed
     */
    public function paginate($perPage = 1, $columns = array('*'), $page = 1)
    {
        return $this->model->paginate($perPage, $columns, '', $page);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param int $page
     * @param null $where
     * @return mixed
     */
    public function paginateWhere($perPage = 1, $columns = array('*'), $page = 1, $where = null)
    {
        if (is_null($where))
            return $this->paginate($perPage, $columns, $page);
        else {

            $model = $this->model;

            $builder = $model->newQuery();

            SearchApi::applyFilters($where, $builder);

            return $builder->paginate($perPage, $columns, '', $page);
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere($where, $columns = array('*'))
    {
        $model = $this->model;

        SearchApi::applyFilters($where, $model);

        return $model->get($columns);
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * @param $where
     * @return mixed
     */
    public function countWhere($where)
    {
        $builder = $this->model->newQuery();

        SearchApi::applyFilters($where, $builder);

        return $builder->count();
    }

    /**
     * @param $field
     * @return mixed
     */
    public function max($field)
    {
        return $this->model->max($field);
    }

    /**
     * @param $field
     * @param $where
     * @return mixed
     */
    public function maxWhere($field, $where)
    {
        $model = $this->model;

        SearchApi::applyFilters($where, $model);

        return $model->max($field);
    }
}