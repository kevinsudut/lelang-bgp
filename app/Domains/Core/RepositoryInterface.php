<?php

/**
 * @author Kevin Surya Wahyudi <kevinsuryaw@gmail.com>
 *
 * Copyright © 2018 | All rights reserved.
 */

namespace App\Domains\Core;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 * @package App\Domains\Core
 */
interface RepositoryInterface
{
    /**
     * Function new model to create new instance of model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function newModel();

    /**
     * Function get model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();

    /**
     * Function set model to change current model instance with other instance
     *
     * @param \Illuminate\Database\Eloquent\Model
     * @return void
     */
    public function setModel(Model $model);

    /**
     * Function set new model to change current model instance with spesific instance from newMode() function
     *
     * @return void
     */
    public function setNewModel();

    /**
     * Function count to count of records data from database
     *
     * @return int count of records data
     */
    public function count();

    /**
     * Function get last inserted to get last inserted data
     *
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getLastInserted(array $columns = ['*']);

    /**
     * Function get all of records data from database
     *
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getAll(array $columns = ['*']);

    /**
     * Function get all of records data from database with spesific sort value
     *
     * @param string $column to sorting by spesific column
     * @param string $type sorting in ascending or descending, the default value is ascending
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getAllSortBy(
        string $column,
        string $type = 'asc',
        array $columns = ['*']
    );

    /**
     * Function get record data by id from database
     *
     * @param $id primary key
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getById($id, array $columns = ['*']);

    /**
     * Function get all of records data from database with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getAllWhere(array $conditions, array $columns = ['*']);

    /**
     * Function get all of records data from database with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param string $column to sorting by spesific column
     * @param string $type sorting in ascending or descending, the default value is ascending
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getAllWhereSortBy(
        array $conditions,
        string $column,
        string $type = 'asc',
        array $columns = ['*']
    );

    /**
     * Function get one record data from database with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getOneWhere(array $conditions, array $columns = ['*']);

    /**
     * Function get all of records data from database with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param string $column to sorting by spesific column
     * @param string $type sorting in ascending or descending, the default value is ascending
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getOneWhereSortBy(
        array $conditions,
        string $column,
        string $type = 'asc',
        array $columns = ['*']
    );

    /**
     * Function get all of records data from database with the relationship
     *
     * @param string $relations relations name
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAllWith(string $relations, array $columns = ['*']);

    /**
     * Function get all of records data from database with spesific sort value and the relationship
     *
     * @param string $relations relations name
     * @param string $column to sorting by spesific column
     * @param string $type sorting in ascending or descending, the default value is ascending
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getAllWithSortBy(
        string $relations,
        string $column,
        string $type = 'asc',
        array $columns = ['*']
    );

    /**
     * Function get record data by id from database with the relationship
     *
     * @param $id primary key
     * @param string $relations relations name
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getByIdWith($id, string $relations, array $columns = ['*']);

    /**
     * Function get all of records data from database with spesific conditions and the relationship
     *
     * @param string $relations relations name
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getAllWithWhere(
        string $relations,
        array $conditions,
        array $columns = ['*']
    );

    /**
     * Function get one record data from database with spesific conditions and the relationship
     *
     * @param string $relations relations name
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getOneWithWhere(
        string $relations,
        array $conditions,
        array $columns = ['*']
    );

    /**
     * Function to check the eloquent model has value
     *
     * @param string $value value name
     *
     * @return void
     */
    public function has(string $value);

    /**
     * Function to paginate data with paginate() function from eloquent model
     *
     * @param int $limit of results to return per page
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function paginate(int $limit = null, array $columns = ['*']);

    /**
     * Function to paginate data with paginate() function from eloquent model with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param int $limit of results to return per page
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function paginateWhere(
        array $conditions,
        int $limit = null,
        array $columns = ['*']
    );

    /**
     * Function to paginate data with paginate() function from eloquent model with spesific sort value
     *
     * @param string $column to sorting by spesific column
     * @param string $type sorting in ascending or descending, the default value is ascending
     * @param int $limit of results to return per page
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function paginateSortBy(
        string $column,
        string $type = 'asc',
        int $limit = null,
        array $columns = ['*']
    );

    /**
     * Function to paginate data with paginate() function from eloquent model with spesific conditions and sort value
     *
     * @param string $column to sorting by spesific column
     * @param string $type sorting in ascending or descending, the default value is ascending
     * @param int $limit of results to return per page
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function paginateWhereSortBy(
        array $conditions,
        string $column,
        string $type = 'asc',
        int $limit = null,
        array $columns = ['*']
    );

    /**
     * Function to paginate data with simplePaginate() function from eloquent model
     *
     * @param int $limit of results to return per page
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function simplePaginate(int $limit = null, array $columns = ['*']);

    /**
     * Function to paginate data with simplePaginate() function from eloquent model with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param int $limit of results to return per page
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function simplePaginateWhere(
        array $conditions,
        int $limit = null,
        array $columns = ['*']
    );

    /**
     * Function to paginate data with simplePaginate() function from eloquent model with spesific sort value
     *
     * @param string $column to sorting by spesific column
     * @param string $type sorting in ascending or descending, the default value is ascending
     * @param int $limit of results to return per page
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function simplePaginateSortBy(
        string $column,
        string $type = 'asc',
        int $limit = null,
        array $columns = ['*']
    );

    /**
     * Function to paginate data with simplePaginate() function from eloquent model with spesific conditions and sort value
     *
     * @param string $column to sorting by spesific column
     * @param string $type sorting in ascending or descending, the default value is ascending
     * @param int $limit of results to return per page
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function simplePaginateWhereSortBy(
        array $conditions,
        string $column,
        string $type = 'asc',
        int $limit = null,
        array $columns = ['*']
    );

    /**
     * Function to insert new data to database
     *
     * @param array $data array contains data that will be inserted
     *
     * @return \Illuminate\Database\Eloquent\Model new inserted data
     */
    public function insert(array $data);

    /**
     * Function to fill the data from \Illuminate\Database\Eloquent\Model object would be inserted or updated
     *
     * @param array $data array contains data that will be inserted or updated
     * @param \Illuminate\Database\Eloquent\Model $model current model that would be inserted or updated
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fill(array $data, Model $model);

    /**
     * Function to update data by id
     *
     * @param $id primary key
     * @param array $data array contains data that will be updated
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $data);

    /**
     * Function to update all data with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param array $data array contains data that will be updated
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function updateWhere(array $conditions, array $data);

    /**
     * Function to delete data by id
     *
     * @param $id primary key
     *
     * @return boolean
     */
    public function delete($id);

    /**
     * Function to delete data with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     *
     * @return boolean
     */
    public function deleteWhere(array $conditions);

    /**
     * Function get record data with deleted items by id from database
     *
     * @param $id primary key
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getByIdWithTrashed($id, array $columns = ['*']);

    /**
     * Function get soft deleted record data by id from database
     *
     * @param $id primary key
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getByIdOnlyTrashed($id, array $columns = ['*']);

    /**
     * Function get soft deleted record data with deleted items from database with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getOneWhereWithTrashed(
        array $conditions,
        array $columns = ['*']
    );

    /**
     * Function get soft deleted record data from database with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     * @param array $columns to retrieve spesific column with the objects
     *
     * @return mixed collections from \Illuminate\Database\Eloquent\Model
     */
    public function getOneWhereOnlyTrashed(
        array $conditions,
        array $columns = ['*']
    );

    /**
     * Function restore soft deleted record data by id from database
     *
     * @param $id primary key
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function restore($id);

    /**
     * Function to force delete data by id
     *
     * @param $id primary key
     *
     * @return boolean
     */
    public function forceDelete($id);

    /**
     * Function to force delete data with spesific conditions
     *
     * @param array $conditions conditions value, must be 3 data in the array. Ex. ['category_id', '=', '1'] ['name', 'like', '%S%']
     *
     * @return boolean
     */
    public function forceDeleteWhere(array $conditions);
}
