<?php

namespace App\Domains\Wallet;

use App\Domains\Core\Repository;
use App\Models\Wallet\Wallet;
use Illuminate\Database\Eloquent\Model;

class WalletRepository extends Repository
{
    public function __construct(Wallet $wallet)
    {
        parent::__construct($wallet);
    }

    public function newModel()
    {
        return new Wallet();
    }

    public function fill(array $data, Model $model)
    {
        $model->user_id = $data['user_id'];
        $model->amount = $data['amount'];
        return $model;
    }

    public function topup($user, $amount)
    {
        $wallet = $this->getOneWhere(['user_id', '=', $user]);

        if ($wallet) {
            return $this->update($wallet->id, [
                'user_id' => $user,
                'amount' => $wallet->amount + $amount,
            ]);
        }

        return $this->insert([
            'user_id' => $user,
            'amount' => $amount,
        ]);
    }
}
