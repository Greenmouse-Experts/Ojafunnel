<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course() {
        return $this->belongsTo(\App\Models\Course::class, 'course_id');
    }

    public function quiz() {
        return $this->belongsTo(\App\Models\LmsQuiz::class, 'quiz_id');
    }

    public function question() {
        return $this->belongsTo(\App\Models\Quiz::class, 'question_id');
    }
}
