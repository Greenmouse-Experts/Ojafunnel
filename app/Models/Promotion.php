<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function promoter()
    {
        return $this->belongsTo(User::class, 'promoter_id');
    }

    public function storeOwner()
    {
        return $this->belongsTo(User::class, 'store_owner_id');
    }

    public function order()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

}
