<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipboardExamination extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'examination_code',
        'staff_id'
    ];
    public function assessment_questions()
    {
        return $this->hasMany(ShipboardExaminationAnswer::class, 'examination_id')->inRandomOrder();
    }
}
