<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BumpsellSubmission extends Model
{
    use HasFactory;

    public function page() {
        return $this->belongsTo(\App\Models\Page::class, 'page_id');
    }
}
