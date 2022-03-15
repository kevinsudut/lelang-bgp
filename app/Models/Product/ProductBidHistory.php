<?php

namespace App\Models\Product;

use App\Models\Account\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBidHistory extends Model
{
    use HasFactory, SoftDeletes;

    public const BIDDING = 1;
    public const REFUND = 2;
    public const WINNER = 3;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productBidSnapshots()
    {
        return $this->hasMany(ProductBidSnapshot::class);
    }
}
