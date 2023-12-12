<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(StoreProduct::class);
    }

    public function order()
    {
        return $this->hasMany(StoreOrder::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getAll()
    {
        return self::select('stores.*');
    }
}
