<?php

namespace App\Domains\Product;

use App\Domains\Core\Repository;
use App\Models\Product\ProductBidHistory;
use Illuminate\Database\Eloquent\Model;

class ProductBidHistoryRepository extends Repository
{
    public function __construct(ProductBidHistory $productBidHistory)
    {
        parent::__construct($productBidHistory);
    }

    public function newModel()
    {
        return new ProductBidHistory();
    }

    public function fill(array $data, Model $model)
    {
        $model->product_id = $data['product_id'];
        $model->user_id = $data['user_id'];
        $model->wallet_id = $data['wallet_id'];
        $model->wallet_id = $data['wallet_id'];
        $model->amount = $data['amount'];
        $model->status = $data['status'];
        return $model;
    }
}
