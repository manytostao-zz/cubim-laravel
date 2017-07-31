<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 30/07/2017
 * Time: 13:42
 */

namespace CUBiM\Repositories;


/**
 * Interface IRepository
 * @package CUBiM\Repositories
 */
interface IRepository
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param int $perPage
     * @param array $columns
     * @param int $page
     * @return mixed
     */
    public function paginate($perPage = 1, $columns = array('*'), $page = 1);

    /**
     * @param int $perPage
     * @param array $columns
     * @param int $page
     * @param null $where
     * @return mixed
     */
    public function paginateWhere($perPage = 1, $columns = array('*'), $page = 1, $where = null);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id");

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Finds a record by it's id.
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * @param $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere($where, $columns = array('*'));

    /**
     * @return mixed
     */
    public function count();

    /**
     * @param $where
     * @return mixed
     */
    public function countWhere($where);

    /**
     * @param $field
     * @return mixed
     */
    public function max($field);

    /**
     * @param $field
     * @param $where
     * @return mixed
     */
    public function maxWhere($field, $where);

}