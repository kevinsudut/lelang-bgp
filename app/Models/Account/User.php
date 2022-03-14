<?php

namespace App\Models\Account;

use App\Models\Notification\Notification;
use App\Models\Product\Product;
use App\Models\Product\ProductBidSnapshot;
use App\Models\Wallet\Wallet;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function maskName()
    {
        $mask = '';

        $maskArr = [];
        $nameArr = explode(' ', $this->name);

        foreach ($nameArr as $arr) {
            if (strlen($arr) <= 3) {
                $maskArr[] = Str::of($arr)->mask('*', 0);
                continue;
            }

            $maskArr[] = Str::of($arr)->mask('*', 3);
        }

        $mask = implode(' ', $maskArr);

        return $mask;
    }

    public function getCountUnreadNotificationAttribute()
    {
        return Notification::where('user_id', $this->id)
            ->where('is_read', 0)
            ->count();
    }

    public function getUnreadNotification($take)
    {
        return Notification::where('user_id', $this->id)
            ->where('is_read', 0)
            ->orderBy('created_at', 'desc')
            ->take($take)
            ->get();
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productBidSnapshots()
    {
        return $this->hasMany(ProductBidSnapshot::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
