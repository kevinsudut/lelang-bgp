<?php

namespace App\Domains\Wallet;

use App\Domains\Core\Repository;
use App\Models\Wallet\WalletHistory;
use Illuminate\Database\Eloquent\Model;

class WalletHistoryRepository extends Repository
{
    public function __construct(WalletHistory $walletHistory)
    {
        parent::__construct($walletHistory);
    }

    public function newModel()
    {
        return new WalletHistory();
    }

    public function fill(array $data, Model $model)
    {
        $model->wallet_id = $data['wallet_id'];
        $model->amount = $data['amount'];
        $model->type = $data['type'];
        return $model;
    }

    public function topup($wallet, $amount)
    {
        return $this->insert([
            'wallet_id' => $wallet,
            'amount' => $amount,
            'type' => WalletHistory::TOP_UP,
        ]);
    }

    public function deduct($wallet, $amount)
    {
        return $this->insert([
            'wallet_id' => $wallet,
            'amount' => $amount,
            'type' => WalletHistory::DEDUCT,
        ]);
    }

    public function refund($wallet, $amount)
    {
        return $this->insert([
            'wallet_id' => $wallet,
            'amount' => $amount,
            'type' => WalletHistory::REFUND,
        ]);
    }
}
