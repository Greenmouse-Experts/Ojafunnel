<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getCurrency($cid) {
        $course = \App\Models\Course::find($cid);
        return $course->currency;
    }
}
