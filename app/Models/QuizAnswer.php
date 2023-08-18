<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'user_id',
        'sessions',
        'course_id',
        'scores',
        'user_answers',
        'real_answers',
    ];
}
