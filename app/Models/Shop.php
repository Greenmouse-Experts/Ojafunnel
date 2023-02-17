<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function course()
    // {
    //     return $this->hasMany(Course::class);
    // }

    // public function order()
    // {
    //     return $this->hasMany(StoreOrder::class);
    // }
}
