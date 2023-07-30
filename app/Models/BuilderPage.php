<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Dotlogics\Grapesjs\App\Contracts\Editable;

class BuilderPage extends Model implements Editable
{
    use HasFactory;
    use EditableTrait;

    protected $guarded = [];
}
