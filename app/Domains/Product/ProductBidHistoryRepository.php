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

    public function getBiddingByUserAndProduct($user, $product)
    {
        return $this->model->where('user_id', $user)->where('product_id', $product)->first();
    }

    public function bidding($product, $user, $wallet, $amount) {
        $history = $this->getBiddingByUserAndProduct($user, $product);

        if ($history != null) {
            return $this->update($history->id, [
                'product_id' => $product,
                'user_id' => $user,
                'wallet_id' => $wallet,
                'amount' => $amount,
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

    public function leaderboard($product)
    {
        return $this->model->where('product_id', $product)->selectRaw('COUNT(1) as count_participant, IFNULL(MAX(amount), 0) max_amount')->first();
    }
}
