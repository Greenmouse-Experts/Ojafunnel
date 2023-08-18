<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'session',
        'course_id',
        'user_id',
        'questions',
        'option1',
        'option2',
        'option3',
        'option4',
        'ans',
    ];
}
