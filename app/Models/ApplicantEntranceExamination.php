<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantEntranceExamination extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $fillable = [
        'applicant_id',
        'is_finish'
    ];
    public function applicant()
    {
        return $this->belongsTo(ApplicantAccount::class, 'applicant_id');
    }
    public function result()
    {
        $_item =  $this->applicant->course_id == 3 ? 100 : 200;
        $_score = $this->hasMany(ApplicantExaminationAnswer::class, 'examination_id')
            ->join('bma_portal.examination_question_choices as eqc', 'eqc.id', 'applicant_examination_answers.question_id')
            ->where('eqc.is_answer', true)->sum('eqc.is_answer');
        $_percent = ($_score / $_item) * 100;
        $_passing = $this->applicant->course_id == 3 ? 50 : 50;
        return $_percent >= $_passing ? true : false;
    }
}
