<?php

/**
 * @author Kevin Surya Wahyudi <kevinsuryaw@gmail.com>
 *
 * Copyright © 2018 | All rights reserved.
 */

namespace App\Domains\Core;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Core\Exceptions\FailedArgumentException;
use Illuminate\Support\Str;

/**
 * Class Repository
 * @package App\Domains\Core
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model;
     */
    protected $model = null;

    /**
     * @var $guid
     *
     * Change true if the primary key is using guid
     * Change false if the primary key is auto increment
     */
    protected $guid = true;

    /**
     * @var $hasIdAttribute
     *
     * Change true if the model have id attribute
     * Change false if the model not have id attribute
     */
    protected $hasIdAttribute = true;

    /**
     * Constructor function of Repository
     *
     * @param \Illuminate\Database\Eloquent\Model
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model|null
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     *
     */
    public function setNewModel()
    {
        $this->model = $this->newModel();
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * @param array|string[] $columns
     * @return Model|object|null
     */
    public function getLastInserted(array $columns = ['*'])
    {
        return $this->model->orderBy('created_at', 'desc')->first($columns);
    }

    /**
     * @param array|string[] $columns
     * @return \Illuminate\Database\Eloquent\Collection|Model[]|mixed
     */
    public function getAll(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * @param string $column
     * @param string $type
     * @param array|string[] $columns
     * @return \Illuminate\Support\Collection|mixed
     */
    public function getAllSortBy(
        string $column,
        string $type = 'asc',
        array $columns = ['*']
    ) {
        return $this->model->orderBy($column, $type)->get($columns);
    }

    /**
     * @param primary $id
     * @param array|string[] $columns
     * @return Model|mixed
     */
    public function getById($id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param array $conditions
     * @param array|string[] $columns
     * @return \Illuminate\Support\Collection|mixed
     * @throws FailedArgumentException
     */
    public function getAllWhere(array $conditions, array $columns = ['*'])
    {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->get($columns);
    }

    /**
     * @param array $conditions
     * @param string $column
     * @param string $type
     * @param array|string[] $columns
     * @return \Illuminate\Support\Collection|mixed
     * @throws FailedArgumentException
     */
    public function getAllWhereSortBy(
        array $conditions,
        string $column,
        string $type = 'asc',
        array $columns = ['*']
    ) {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->orderBy($column, $type)
            ->get($columns);
    }

    /**
     * @param array $conditions
     * @param array|string[] $columns
     * @return Model|mixed|object|null
     * @throws FailedArgumentException
     */
    public function getOneWhere(array $conditions, array $columns = ['*'])
    {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->first($columns);
    }

    /**
     * @param array $conditions
     * @param string $column
     * @param string $type
     * @param array|string[] $columns
     * @return Model|mixed|object|null
     * @throws FailedArgumentException
     */
    public function getOneWhereSortBy(
        array $conditions,
        string $column,
        string $type = 'asc',
        array $columns = ['*']
    ) {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->orderBy($column, $type)
            ->first($columns);
    }

    /**
     * @param string $relations
     * @param array|string[] $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function getAllWith(string $relations, array $columns = ['*'])
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * @param string $relations
     * @param string $column
     * @param string $type
     * @param array|string[] $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getAllWithSortBy(
        string $relations,
        string $column,
        string $type = 'asc',
        array $columns = ['*']
    ) {
        return $this->model
            ->with($relations)
            ->orderBy($column, $type)
            ->get($columns);
    }

    /**
     * @param primary $id
     * @param string $relations
     * @param array|string[] $columns
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function getByIdWith($id, string $relations, array $columns = ['*'])
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    /**
     * @param string $relations
     * @param array $conditions
     * @param array|string[] $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     * @throws FailedArgumentException
     */
    public function getAllWithWhere(
        string $relations,
        array $conditions,
        array $columns = ['*']
    ) {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->with($relations)
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->get($columns);
    }

    /**
     * @param string $relations
     * @param array $conditions
     * @param array|string[] $columns
     * @return \Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     * @throws FailedArgumentException
     */
    public function getOneWithWhere(
        string $relations,
        array $conditions,
        array $columns = ['*']
    ) {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->with($relations)
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->first($columns);
    }

    /**
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder|Model|void
     */
    public function has(string $value)
    {
        return $this->model->has($value);
    }

    /**
     * @param int|null $limit
     * @param array|string[] $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginate(int $limit = null, array $columns = ['*'])
    {
        return $this->model->paginate($limit, $columns);
    }

    /**
     * @param array $conditions
     * @param int|null $limit
     * @param array|string[] $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     * @throws FailedArgumentException
     */
    public function paginateWhere(
        array $conditions,
        int $limit = null,
        array $columns = ['*']
    ) {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->paginate($limit, $columns);
    }

    /**
     * @param string $column
     * @param string $type
     * @param int|null $limit
     * @param array|string[] $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginateSortBy(
        string $column,
        string $type = 'asc',
        int $limit = null,
        array $columns = ['*']
    ) {
        return $this->model
            ->orderBy($column, $type)
            ->paginate($limit, $columns);
    }

    /**
     * @param array $conditions
     * @param string $column
     * @param string $type
     * @param int|null $limit
     * @param array|string[] $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginateWhereSortBy(
        array $conditions,
        string $column,
        string $type = 'asc',
        int $limit = null,
        array $columns = ['*']
    ) {
        return $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->orderBy($column, $type)
            ->paginate($limit, $columns);
    }

    /**
     * @param int|null $limit
     * @param array|string[] $columns
     * @return \Illuminate\Contracts\Pagination\Paginator|mixed
     */
    public function simplePaginate(int $limit = null, array $columns = ['*'])
    {
        return $this->model->simplePaginate($limit, $columns);
    }

    /**
     * @param array $conditions
     * @param int|null $limit
     * @param array|string[] $columns
     * @return \Illuminate\Contracts\Pagination\Paginator|mixed
     * @throws FailedArgumentException
     */
    public function simplePaginateWhere(
        array $conditions,
        int $limit = null,
        array $columns = ['*']
    ) {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->simplePaginate($limit, $columns);
    }

    /**
     * @param string $column
     * @param string $type
     * @param int|null $limit
     * @param array|string[] $columns
     * @return \Illuminate\Contracts\Pagination\Paginator|mixed
     */
    public function simplePaginateSortBy(
        string $column,
        string $type = 'asc',
        int $limit = null,
        array $columns = ['*']
    ) {
        return $this->model
            ->orderBy($column, $type)
            ->simplePaginate($limit, $columns);
    }

    /**
     * @param array $conditions
     * @param string $column
     * @param string $type
     * @param int|null $limit
     * @param array|string[] $columns
     * @return \Illuminate\Contracts\Pagination\Paginator|mixed
     */
    public function simplePaginateWhereSortBy(
        array $conditions,
        string $column,
        string $type = 'asc',
        int $limit = null,
        array $columns = ['*']
    ) {
        return $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->orderBy($column, $type)
            ->simplePaginate($limit, $columns);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function insert(array $data)
    {
        $model = $this->newModel();
        if ($this->guid && $this->hasIdAttribute) {
            $model->id = Str::uuid()->toString();
        }
        $model = $this->fill($data, $model);
        $model->save();
        return $model;
    }

    /**
     * @param primary $id
     * @param array $data
     * @return Model|null
     */
    public function update($id, array $data)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model = $this->fill($data, $model);
            $model->save();
            return $model;
        }
        return null;
    }

    /**
     * @param array $conditions
     * @param array $data
     * @return \Illuminate\Support\Collection|mixed
     * @throws FailedArgumentException
     */
    public function updateWhere(array $conditions, array $data)
    {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        $model = $this->model
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->get();
        foreach ($model as $m) {
            $m = $this->fill($data, $m);
            $m->save();
        }
        return $model;
    }

    /**
     * @param primary $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->delete();
            return true;
        }
        return false;
    }

    /**
     * @param array $conditions
     * @return bool
     * @throws FailedArgumentException
     */
    public function deleteWhere(array $conditions)
    {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        $model = $this->model->where(
            $conditions[0],
            $conditions[1],
            $conditions[2]
        );
        if ($model) {
            $model->delete();
            return true;
        }
        return false;
    }

    /**
     * @param primary $id
     * @param array|string[] $columns
     * @return Model
     */
    public function getByIdWithTrashed($id, array $columns = ['*'])
    {
        return $this->model->withTrashed()->find($id, $columns);
    }

    /**
     * @param primary $id
     * @param array|string[] $columns
     * @return Model
     */
    public function getByIdOnlyTrashed($id, array $columns = ['*'])
    {
        return $this->model->onlyTrashed()->find($id, $columns);
    }

    /**
     * @param array $conditions
     * @param array|string[] $columns
     * @return mixed
     * @throws FailedArgumentException
     */
    public function getOneWhereWithTrashed(
        array $conditions,
        array $columns = ['*']
    ) {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->withTrashed()
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->first($columns);
    }

    /**
     * @param array $conditions
     * @param array|string[] $columns
     * @return mixed
     * @throws FailedArgumentException
     */
    public function getOneWhereOnlyTrashed(
        array $conditions,
        array $columns = ['*']
    ) {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        return $this->model
            ->onlyTrashed()
            ->where($conditions[0], $conditions[1], $conditions[2])
            ->first($columns);
    }

    /**
     * @param primary $id
     * @return Model|null
     */
    public function restore($id)
    {
        $model = $this->getByIdOnlyTrashed($id);
        if ($model) {
            $model->restore();
            return $model;
        }
        return null;
    }

    /**
     * @param primary $id
     * @return bool
     */
    public function forceDelete($id)
    {
        $model = $this->model->withTrashed()->find($id);
        if ($model) {
            $model->forceDelete();
            return true;
        }
        return false;
    }

    /**
     * @param array $conditions
     * @return bool
     * @throws FailedArgumentException
     */
    public function forceDeleteWhere(array $conditions)
    {
        if (count($conditions) != 3) {
            throw new FailedArgumentException(
                'Invalid conditions argument value'
            );
        }
        $model = $this->model
            ->withTrashed()
            ->where($conditions[0], $conditions[1], $conditions[2]);
        if ($model) {
            $model->forceDelete();
            return true;
        }
        return false;
    }
}
