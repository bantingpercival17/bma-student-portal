<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class StudentDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        "first_name",
        "last_name",
        "middle_name",
        "extention_name",
        "birthday",
        "birth_place",
        "sex",
        "nationality",
        "religion",
        "civil_status",
        "street",
        "barangay",
        "municipality",
        "province",
        "zip_code",
        "contact_number",
        "is_removed"

    ];

    public function profile_pic($_data)
    {
        $_formats = ['.jpeg', '.jpg', '.png'];
        $_path = 'assets/image/student-picture/';
        $_image = "assets/image/student-picture/midship-man.jpg";
        foreach ($_formats as $format) {
            $_image = file_exists(public_path($_path . $_data->student_number . $format)) ? $_path . $_data->student_number . $format : $_image;
        }
        return $_image;
    }
    public function current_enrollment()
    {
        $_academic = request()->input('_academic') ?  $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('academic_id', base64_decode(request()->input('_academic')))->orderBy('id', 'desc') :  $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('is_removed', 0)->orderBy('id', 'desc');
        return $_academic;
        //return $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('is_removed', 0)->orderBy('id', 'desc');
    }
    public function enrollment_application()
    {
        return $this->hasOne(EnrollmentApplication::class, 'student_id');
    }
    public function enrollment_assessment()
    {
        return $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('is_removed', 0)->orderBy('id', 'desc');
    }
    public function enrollment_history()
    {
        return $this->hasMany(EnrollmentAssessment::class, 'student_id')->where('is_removed', 0)->orderBy('id', 'desc');
    }
    public function account()
    {
        return $this->hasOne(StudentAccount::class, 'student_id');
    }
    public function parent_details()
    {
        return $this->hasOne(ParentDetails::class, 'student_id');
    }
    public function educational_details()
    {
        return $this->hasMany(EducationalDetails::class, 'student_id');
    }
    public function educational_background()
    {
        return $this->hasMany(EducationalDetails::class, 'student_id');
    }
    public function section($_academic)
    {
        return $this->hasOne(StudentSection::class, 'student_id')->select('student_sections.id', 'student_sections.student_id', 'student_sections.section_id')
            ->join('sections', 'sections.id', 'student_sections.section_id')->where('sections.academic_id', $_academic)->where('student_sections.is_removed', false);
    }
    public function shipboard_training()
    {
        return $this->hasOne(ShipBoardInformation::class, 'student_id');
    }
    public function shipboard_journal()
    {
        return $this->hasMany(ShipboardJournal::class, 'student_id')->distinct();
    }
    public function non_academic_clearance($_data)
    {
        $_enrollment = $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('is_removed', 0)->latest('id')->first();
        return $this->hasOne(StudentNonAcademicClearance::class, 'student_id')->where('academic_id', $_enrollment->academic_id)->where('non_academic_type', str_replace(' ', '-', strtolower($_data)))->where('is_removed', false)->latest('id')->first();
        //return $this->hasOne(StudentNonAcademicClearance::class, 'student_id')->where('non_academic_type', str_replace(' ', '-', strtolower($_data)))->where('is_removed', false)->first();
    }
    public function clearance_status()
    {
        $_non_academic_count  = 8;
        $_enrollment = $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('is_removed', 0)->latest('id')->first();
        $_section  = $this->hasOne(StudentSection::class, 'student_id')->select('student_sections.id', 'student_sections.student_id', 'student_sections.section_id')
            ->join('sections', 'sections.id', 'student_sections.section_id')->where('sections.academic_id', $_enrollment->academic_id)->where('student_sections.is_removed', false)->first();
        //$_section = $this->hasOne(StudentSection::class, 'student_id')->where('is_removed', 0)->latest('id')->first();
        $_student_non_academic_clearance = $this->hasMany(StudentNonAcademicClearance::class, 'student_id')->where('is_removed', false)->where('is_approved', true)->where('academic_id', $_enrollment->academic_id);
        $_academic_clearance = $this->hasMany(StudentClearance::class, 'student_id')->where('is_approved', true)->where('is_removed', false);
        if ($_section) {
            $_subject_count = SubjectClass::where('section_id', $_section->section_id)->where('is_removed', false)->get();
            $_subject_count =  $_subject_count->count();
            if ($_enrollment->bridging_program == 'without' && $_enrollment->academic->semester == 'First Semester' && $_enrollment->year_level == 4) {
                $_subject_count -= 1;
            }
            //return $_student_non_academic_clearance->count();
            return $_non_academic_count == $_student_non_academic_clearance->count() && $_subject_count == $_academic_clearance->count() ? 1 : 0;
            // return $_subject_count == $_academic_clearance->count() ? 'CLEARED' : 'NOT CLEARED';
        } else {
            return 0;
        }
        //return $_non_academic_count == $_student_clearance->count() ? 'CLEARED' : 'NOT CLEARED';
    }
}
