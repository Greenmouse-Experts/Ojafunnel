<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUser extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(StoreOrder::class, 'store_order_id');
    }
}
