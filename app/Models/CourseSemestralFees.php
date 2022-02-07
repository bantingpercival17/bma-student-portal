<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSemestralFees extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'curriculum_id', 'academic_id', 'year_level', 'is_removed'];

    public function semestral_fees($_data)
    {
        return SemestralFee::select('p.particular_tag')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'pf.id', 'semestral_fees.particular_fee_id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('semestral_fees.course_semestral_fee_id', $_data)
            ->groupBy('p.particular_tag')
            ->where('p.particular_tag', '!=', 'addition_tags')
            ->get();
    }
    public function semestral_tuition($_data)
    {
        $_semestral_fee = SemestralFee::select('p.particular_tag')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'pf.id', 'semestral_fees.particular_fee_id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('semestral_fees.course_semestral_fee_id', $_data->payment_assessments->course_semestral_fee->id)
            ->groupBy('p.particular_tag')
            ->where('p.particular_tag', '!=', 'addition_tags')
            ->get();

        if ($_data->course_id == 3) {
            return $_semestral_fee;
        } else {
            // For College 
            // Get Total Units
        }
    }
    public function additional_fees($_data)
    {
        return SemestralFee::select('p.particular_name', 'pf.particular_amount')
            /* ->selectRaw("sum(pf.particular_amount) as fees") */
            ->join('particular_fees as pf', 'pf.id', 'semestral_fees.particular_fee_id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('semestral_fees.course_semestral_fee_id', $_data)
            /*  ->groupBy('p.particular_tag') */
            ->where('p.particular_tag', '=', 'addition_tags')
            ->get();
    }
    public function course()
    {
        return $this->belongsTo(CourseOffer::class, 'course_id');
    }
    public function academic()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_id');
    }
    public function fee()
    {
        return $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->where('semestral_fees.is_removed', false);
    }
}
