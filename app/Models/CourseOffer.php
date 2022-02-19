<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseOffer extends Model
{
    use HasFactory;
    protected $fillable = ['course_name', 'course_code', 'school_level', 'is_removed'];
    public function course_subject($_data)
    {
        return $this->hasMany(CurriculumSubject::class, 'course_id')
            ->select('curriculum_subjects.id', 'subjects.subject_code', 'subjects.subject_name')
            ->join('subjects', 'subjects.id', 'curriculum_subjects.subject_id')
            ->where('curriculum_subjects.curriculum_id', $_data[0])
            ->where('curriculum_subjects.year_level', $_data[1])
            ->where('curriculum_subjects.semester', $_data[2])
            ->get();
    }
    public function section($_data)
    {
        return $this->hasMany(Section::class, 'course_id')
            ->where('sections.academic_id', $_data[0])
            ->where('sections.year_level', $_data[1])
            ->where('is_removed', false)
            /* ->get() */;
    }
    public function units($_data)
    {
        return $this->hasMany(CurriculumSubject::class, 'course_id')
            ->selectRaw("sum(s.units) as units")
            ->join('subjects as s', 's.id', 'curriculum_subjects.subject_id')
            ->where('curriculum_subjects.year_level', $_data->year_level)
            ->where('curriculum_subjects.curriculum_id', $_data->curriculum_id)
            ->where('curriculum_subjects.semester', $_data->academic->semester)
            ->first();
    }
}
