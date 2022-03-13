<?php

namespace App\Models\Wallet;

use App\Models\Account\User;
use App\Models\Product\ProductBidHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    public function getAmmountFormatAttribute()
    {
        return 'IDR ' . number_format($this->amount);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductBidHistory::class);
    }

    public function walletHistories()
    {
        return $this->hasMany(WalletHistory::class)->orderBy('created_at', 'desc');
    }
}
