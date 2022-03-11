<?php

namespace App\Domains\Product;

use App\Domains\Core\Repository;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends Repository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function newModel()
    {
        return new Product();
    }

    public function fill(array $data, Model $model)
    {
        $model->user_id = $data['user_id'];
        $model->name = $data['name'];
        $model->description  = $data['description'];
        $model->image = $data['image'];
        $model->start_time = $data['start_time'];
        $model->end_time = $data['end_time'];
        $model->start_bid = $data['start_bid'];
        $model->minimum_bid = $data['minimum_bid'];
        return $model;
    }
}
