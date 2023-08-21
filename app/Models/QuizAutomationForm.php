<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAutomationForm extends Model
{
    use HasFactory;

    public function formfields() {
        return $this->hasMany(\App\Models\QuizAutomationFormField::class, 'quiz_automation_id');
    }
}
