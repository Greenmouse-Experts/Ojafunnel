<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->hasMany(OrderUser::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public static function getAll()
    {
        return self::select('store_orders.*');
    }
}
