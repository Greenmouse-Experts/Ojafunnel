<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function funnels() {
        return $this->hasMany(Funnel::class, 'funnel_category_id');
    }
}
