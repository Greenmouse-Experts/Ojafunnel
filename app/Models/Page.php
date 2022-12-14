<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Dotlogics\Grapesjs\App\Contracts\Editable;

class Page extends Model implements Editable
{
    use HasFactory;
    use EditableTrait;

    protected $fillable = [
        'user_id',
        'name',
        'title',
        'thumbnail',
        'body',
        'listable',
        'gjs_data'
    ];

    public function scopeListable($query)
    {
        return $query->where('listable', 1);
    }
}
