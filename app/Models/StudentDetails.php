<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        $_academic = AcademicYear::where('is_active',true)->first();
        //return request()->input('_academic') ?  $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('academic_id', base64_decode(request()->input('_academic')))->orderBy('id', 'desc') :  $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('is_removed', 0)->where('academic_id',$_academic->id)->orderBy('id', 'desc');

        return $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('is_removed', 0)->orderBy('id', 'desc');
    }
    public function enrollment_application()
    {
        $_academic = AcademicYear::where('is_active',true)->first();
        return $this->hasOne(EnrollmentApplication::class, 'student_id')->where('academic_id',$_academic->id)->where('is_removed',false);
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
        return $this->hasMany(EducationalDetails::class, 'student_id')->where('is_removed',false);
    }
    public function educational_background()
    {
        return $this->hasMany(EducationalDetails::class, 'student_id')->where('is_removed',false);
    }
    public function section()
    {
        $_academic = request()->input('_academic') ? AcademicYear::find(base64_decode(request()->input('_academic'))) : $this->enrollment_assessment->academic;
        //return $_academic->id;
        return $this->hasOne(StudentSection::class, 'student_id')->select('student_sections.id', 'student_sections.student_id', 'student_sections.section_id')
            ->join('sections', 'sections.id', 'student_sections.section_id')->where('sections.academic_id', $_academic->id)->where('student_sections.is_removed', false);
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

    public function student_handbook()
    {
        $_course = Auth::user()->student->enrollment_assessment->course->course_code;
        $_log_name = $_course . '/' . str_replace('@bma.edu.ph', '', Auth::user()->campus_email) . '.json';
        if (file_exists(public_path() . '/storage/student-handbook/' . $_log_name)) {
            $_path = public_path() . '/storage/student-handbook/' . $_log_name;
            return json_decode(file_get_contents($_path), true);
        }
    }
    /* Grading Query */
    public function subject_score($_data)
    {
        $_score =  $this->hasOne(GradeEncode::class, 'student_id')
            ->where('subject_class_id', $_data[0])
            ->where('period', $_data[1])
            ->where('is_removed', false)
            ->where('type', $_data[2])->first();
        return $_score ? $_score->score : '';
    }
    public function subject_average_score($_data)
    {
        $_percent = $_data['2'] == 'Q' || $_data['2'] == 'O' || $_data['2'] == 'R'  ? .15 : .55;
        return $this->hasMany(GradeEncode::class, 'student_id')
            ->where('subject_class_id', $_data[0])
            ->where('period', $_data[1])
            ->where('is_removed', false)
            ->where('type', 'like',  $_data[2] . "%")->average('score') * $_percent;
    }
    function lec_grade($_data)
    {
        $_tScore = 0;
        $_category = [['Q', 15], ['O', 15], ['R', 15], [$_data[1][0] . 'E', 55]];
        $_count = 0;
        foreach ($_category as $key => $_categ) {
            $_score = $this->hasMany(GradeEncode::class, 'student_id')
                ->where('subject_class_id', $_data[0])
                ->where('period', $_data[1])
                ->where('is_removed', false)
                ->where('type', 'like',  $_categ[0] . "%")->average('score');
            $_count +=   $_score > 0 ? 1 : 0;
            $_tScore += $_score * ($_categ[1] / 100);
        }
        return 4 == $_count ? $_tScore * .4 : 0;
    }
    public function lab_grade($_data)
    {
        return $this->hasMany(GradeEncode::class, 'student_id')
            ->where('subject_class_id', $_data[0])
            ->where('period', $_data[1])
            ->where('type', 'like',  "A%")
            ->where('is_removed', false)->average('score') * .60;
    }
    public function final_grade($_data, $_period)
    {

        $_final_grade = 0;
        $midtermGradeLecture = $this->lec_grade([$_data, 'midterm']);
        $midtermGradeLaboratory = $this->lab_grade([$_data, 'midterm']);;
        $finalGradeLecture = $this->lec_grade([$_data, 'finals']);
        $finalGradeLaboratory = $this->lab_grade([$_data, 'finals']);
        if ($_period == 'midterm') {
            if ($midtermGradeLaboratory > 0) {
                $_final_grade = $midtermGradeLecture + $midtermGradeLaboratory; // Midterm Grade Formula With Laboratory
            } else {
                $_final_grade = $midtermGradeLecture / .4; // Midterm Grade Formula without Laboratory
            }
        } else {
            if ($finalGradeLaboratory > 0) {
                if ($midtermGradeLaboratory > 0) {
                    $_final_grade =  (($midtermGradeLecture + $midtermGradeLaboratory) * .5) + (($finalGradeLecture + $finalGradeLaboratory) * .5);
                } else {
                    $_final_grade =  (($midtermGradeLecture / .4) * .5) + (($finalGradeLecture + $finalGradeLaboratory) * .5);
                }
            } else {
                if ($midtermGradeLaboratory > 0) {
                    $_final_grade =  (($midtermGradeLecture + $midtermGradeLaboratory) * .5) + (($finalGradeLecture + $finalGradeLaboratory) * .5);
                } else {
                    $_final_grade =  (($midtermGradeLecture / .4) * .5) + (($finalGradeLecture / .4) * .5);
                }
            }
        }
        return $_final_grade;
    }
    public function percentage_grade($_grade)
    {
        $_percent = [
            [0, 69.46, 5.0],
            [69.47, 72.88, 3.0],
            [72.89, 76.27, 2.75],
            [76.28, 79.66, 2.5],
            [79.67, 83.05, 2.25],
            [83.06, 86.44, 2.00],
            [86.45, 89.83, 1.75],
            [89.84, 93.22, 1.5],
            [93.23, 96.61, 1.25],
            [96.62, 100, 1.0]
        ];
        $_percentage = 0;
        foreach ($_percent as $key => $value) {
            $_percentage = $_grade >= $value[0]  && $_grade <= $value[1] ? $value[2] : $_percentage;
        }
        return $_percentage;
    }
    public function grade_publish()
    {
        return $this->hasOne(GradePublish::class, 'student_id')/* ->where('is_removed', false) */;
    }
}
