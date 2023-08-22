<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    public static function getBaseCur($sym)
    {
        $rec = \App\Models\CurrencyRate::where(['fx_symbol' => $sym])->first();

        return $rec ? $rec->fiat : 0;
    }
}
