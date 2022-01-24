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
        return $this->hasOne(StudentNonAcademicClearance::class, 'student_id')->where('non_academic_type', str_replace(' ', '-', strtolower($_data)))->where('is_removed', false)->first();
    }
}
