<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        'academic_id',
        'is_removed'
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
        return $this->hasMany(ApplicantDocuments::class, 'applicant_id')->where('is_removed', false)->orderBy('document_id');
    }
    public function document_status()
    {
        $_level = $this->course_id == 3 ? 11 : 4;
        $_documents = Documents::where('department_id', 2)->where('year_level', $_level)->where('is_removed', false)->count();
        $_document_verified = $this->hasMany(ApplicantDocuments::class, 'applicant_id')->where('is_approved', 1);
        //return $_document_verified->count();
        if ($_document_verified->count() >= $_documents) {
            return true;
        } else {
            return false;
        }
        //return $_document_verified;
        //return $this->hasMany(ApplicantDocuments::class, 'applicant_id')->having(DB::raw("COUNT(CASE WHEN is_approved = 1 THEN 1 END)", '>=', $_documents))->groupBy('applicant_id');
    }
    public function payment()
    {
        return $this->hasOne(ApplicantPayment::class, 'applicant_id')->where('is_removed', false);
    }
}
