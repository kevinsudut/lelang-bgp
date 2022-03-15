<?php

namespace App\Models\Product;

use App\Models\Account\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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

    public function isNotStarted()
    {
        $now = Carbon::now();
        return Carbon::parse($this->start_time)->isAfter($now);
    }

    public function isAlreadyEnded()
    {
        $now = Carbon::now();
        return Carbon::parse($this->end_time)->isBefore($now);
    }

    public function isAlreadyStarted()
    {
        $now = Carbon::now();
        return Carbon::parse($this->start_time)->isBefore($now) && Carbon::parse($this->end_time)->isAfter($now);
    }
}
