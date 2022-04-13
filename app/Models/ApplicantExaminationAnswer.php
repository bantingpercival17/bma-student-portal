<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantExaminationAnswer extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $fillable = [
        'examination_id',
        'question_id',
        'choices_id'
    ];

    public function examination_question_choices()
    {
        return $this->belongsTo(ExaminationQuestionChoice::class, 'choices_id')->where('is_answer', 1);
    }
}
