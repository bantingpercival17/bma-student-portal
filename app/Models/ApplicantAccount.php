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
    public function current_semester()
    {
       return AcademicYear::where('is_active',true)->first();
    }
    public function academic()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_id');
    }
    public function course()
    {
        return $this->belongsTo(CourseOffer::class, 'course_id');
    }
    public function applicant()
    {
        return $this->hasOne(ApplicantDetials::class, 'applicant_id');
    }
    public function is_alumnia()
    {
        return $this->hasOne(ApplicantAlumnia::class, 'applicant_id')->where('is_removed', false);
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
    public function examination()
    {
        return $this->hasOne(ApplicantEntranceExamination::class, 'applicant_id')->where('is_removed', false);
    }
    public function examination_question()
    {
        $_department = $this->course_id == 3 ? 'SENIOR HIGHSCHOOL' : 'COLLEGE';
        return Examination::where('department', $_department)->where('examination_name', 'ENTRANCE EXAMINATION')->where('is_removed', false)->first();
    }
    public function virtual_briefing()
    {
        return $this->hasOne(ApplicantBriefing::class, 'applicant_id')->where('is_removed', false);
    }
    public function medical_appointment()
    {
        return $this->hasOne(ApplicantMedicalAppointment::class, 'applicant_id')->where('is_removed', false);
    }
    public function medical_appointment_slot($_date)
    {
        $_applicant = ApplicantMedicalAppointment::where('appointment_date', $_date)->where('is_removed', false)->count();
        return $_applicant;
        return $this->hasHany(ApplicantMedicalAppointment::class, 'applicant_id')->where('is_removed', false);
    }
    public function medical_result()
    {
        return $this->hasOne(ApplicantMedicalResult::class, 'applicant_id')->where('is_removed', false);
    }
    public function image()
    {
        $_level = $this->course_id == 3 ? 11 : 4;
        $_document = Documents::where('department_id', 2)->where('year_level', $_level)->where('document_name', '2x2 Picture')->where('is_removed', false)->first();
        return $this->hasOne(ApplicantDocuments::class, 'applicant_id')->where('document_id', $_document->id)->where('is_removed', false);
    }
    public function enrollment_registration()
    {
        return StudentDetails::where('first_name', $this->applicant->first_name)
            ->where('last_name', $this->applicant->last_name)
            ->where('middle_name', $this->applicant->middle_name)
            ->where('birthday', $this->applicant->birthday)
            ->where('is_removed', false)
            ->first();
    }
}
