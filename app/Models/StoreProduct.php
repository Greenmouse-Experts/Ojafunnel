<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    use HasFactory;

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function getAll()
    {
        return self::select('store_products.*');
    }
}
