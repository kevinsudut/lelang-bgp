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

    public function getAmountFormatAttribute()
    {
        $amount = 0;

        if ($this->type == WalletHistory::TOP_UP || $this->type == WalletHistory::REFUND) {
            $amount = 'IDR ' . number_format($this->amount);
        }

        if ($this->type == WalletHistory::DEDUCT) {
            $amount = 'IDR -' . number_format($this->amount);
        }

        return $amount;
    }

    public function typeStr()
    {
        $str = "";

        if ($this->type == WalletHistory::TOP_UP) {
            $str = "GoPay top up";
        }

        if ($this->type == WalletHistory::REFUND) {
            $str = "GoPay refund";
        }

        if ($this->type == WalletHistory::DEDUCT) {
            $str = "GoPay deduct";
        }

        return $str;
    }

    public function typeCss()
    {
        $css = "";

        if ($this->type == WalletHistory::TOP_UP || $this->type == WalletHistory::REFUND) {
            $css = "bg-success";
        }

        if ($this->type == WalletHistory::DEDUCT) {
            $css = "bg-danger";
        }

        return $css;
    }
}
