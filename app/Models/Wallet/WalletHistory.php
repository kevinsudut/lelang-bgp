<?php

namespace App\Models\Wallet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletHistory extends Model
{
    use HasFactory, SoftDeletes;

    public const TOP_UP = 1;
    public const DEDUCT = 2;
    public const REFUND = 3;

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function typeStr()
    {
        $str = "";

        if ($this->type == 1) {
            $str = "GoPay top up";
        }

        return $str;
    }

    public function typeCss()
    {
        $css = "";

        if ($this->type == 1) {
            $css = "bg-success";
        }

        return $css;
    }
}
