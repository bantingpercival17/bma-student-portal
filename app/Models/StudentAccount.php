<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentAccount extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'campus_email',
        'personal_email',
        'student_number',
        'password',
        'is_actived',
        'is_removed',
    ];
    public function student()
    {
        return $this->belongsTo(StudentDetails::class,'student_id');
    }
}
