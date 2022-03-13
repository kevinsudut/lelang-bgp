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
        $model->amount = $data['amount'];
        $model->status = $data['status'];
        return $model;
    }

    public function getLargestBidding($product)
    {
        return $this->model->where('product_id', $product)->orderBy('amount', 'desc')->first();
    }

    public function bidding($product, $user, $wallet, $amount) {
        $history = $this->model->where('product_id', $product)->where('user_id', $user)->where('wallet_id', $wallet)->first();

        if ($history != null) {
            return $this->update($history->id, [
                'product_id' => $product,
                'user_id' => $user,
                'wallet_id' => $wallet,
                'amount' => $history->amount + $amount,
                'status' => ProductBidHistory::BIDDING,
            ]);
        }

        return $this->insert([
            'product_id' => $product,
            'user_id' => $user,
            'wallet_id' => $wallet,
            'amount' => $amount,
            'status' => ProductBidHistory::BIDDING,
        ]);
    }
}
