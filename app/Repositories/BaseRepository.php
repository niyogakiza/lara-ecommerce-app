<?php

namespace App\Repositories;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class BaseRepository
 * @package App\Repositories
 */

class BaseRepository implements BaseContract
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Create a model instance
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update a model instance
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->find($id)->update($attributes);
    }

    /**
     * Return all models rows
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * Find one by ID
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
       return $this->model->find($id);
    }

    /**
     * Find one by ID or throw exception
     * @param int $id
     * @return mixed
     */
    public function findOneOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find based on different column
     * @param array $data
     * @return mixed
     */
    public function findBy(array $data)
    {
        return $this->model->where($data)->all();
    }

    /**
     * Find one based on different column
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data)
    {
        return $this->model->where($data)->first();
    }

    /**
     * Find one based on different column or through exception
     * @param array $data
     * @return mixed
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    /**
     * Delete one by Id
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return  $this->model->find($id)->delete();
    }
}
