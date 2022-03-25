<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ApplicantAccount extends  Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $connection = 'mysql2';
    protected $fillable = [
        'name',
        'email',
        'password',
        'applicant_number',
        'contact_number',
        'course_id',
        'academic_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function course()
    {
        return $this->belongsTo(CourseOffer::class, 'course_id');
    }
    public function applicant()
    {
        return $this->hasOne(ApplicantDetials::class, 'applicant_id');
    }
    public function documents()
    {
        return $this->hasMany(ApplicantDocuments::class, 'applicant_id')->where('is_removed', false);
    }
}
