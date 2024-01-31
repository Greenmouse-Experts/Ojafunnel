<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LmsQuiz extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'user_id',
        'course_id',
        'session',
        'quiz_title',
        'time_per_question',
        'description',
    ];
}
