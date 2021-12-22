<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCertificates extends Model
{
    use HasFactory;

    public function student_certificate($_data)
    {
        return $this->hasOne(StudentTraining::class, 'training_id')->where('student_id', $_data)->first();
    }
}
