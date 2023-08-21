<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getCategory($id) {
        if(is_null($id)) {
            return "N/A";
        }

        $rec = \App\Models\FunnelCategory::find($id);
        return $rec->name;
    }
}
