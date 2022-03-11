<?php

namespace App\Models\Product;

use App\Models\Account\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productBidHistories()
    {
        return $this->hasMany(ProductBidHistory::class);
    }
}
