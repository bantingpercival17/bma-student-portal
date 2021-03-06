<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipboardExaminationAnswer extends Model
{
    use HasFactory;

    public function assessment_questions()
    {
        return $this->belongsTo(ShipboardExamination::class, 'examination_id');
    }
    public function question()
    {
        return $this->belongsTo(ExaminationQuestion::class, 'question_id');
    }
}
