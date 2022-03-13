<?php

namespace App\Models\Product;

use App\Models\Account\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBidSnapshot extends Model
{
    use HasFactory, SoftDeletes;

    public function productBidHistory()
    {
        return $this->belongsTo(ProductBidHistory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
