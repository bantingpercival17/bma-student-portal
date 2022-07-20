<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMedicalAppointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'course_id',
        'academic_id',
        'appointment_date',
        'approved_by'
    ];
}
