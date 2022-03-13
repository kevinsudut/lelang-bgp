<?php

namespace App\Domains\Product;

use App\Domains\Core\Repository;
use App\Models\Product\ProductBidHistory;
use App\Models\Product\ProductBidSnapshot;
use Illuminate\Database\Eloquent\Model;

class ProductBidSnapshotRepository extends Repository
{
    public function __construct(ProductBidSnapshot $productBidSnapshot)
    {
        parent::__construct($productBidSnapshot);
    }

    public function newModel()
    {
        return new ProductBidSnapshot();
    }

    public function fill(array $data, Model $model)
    {
        $model->product_bid_history_id = $data['product_bid_history_id'];
        $model->user_id = $data['user_id'];
        $model->amount = $data['amount'];
        return $model;
    }
}
