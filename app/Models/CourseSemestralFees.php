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
    public function particular_tags($_tag)
    {
        $_fees =  $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->select('p.particular_name', 'pf.particular_amount')
            ->join('particular_fees as pf', 'pf.id', 'semestral_fees.particular_fee_id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', '=', $_tag)->sum('pf.particular_amount');
        if ($_tag == 'tuition_tags') {
            $_number_of_units = $this->course->units($this)->units;
            $_fees = $_fees  * $_number_of_units;
        }
        return $_fees;
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
    public function payment_amount($_data)
    {
        if ($_data->payment_mode == 1) {
            // Installment 
            // Get the Monthly Payment
            if ($_data->enrollment_assessment->course_id == 3) {
                $_tuition_fee =  $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
                    ->selectRaw("sum(pf.particular_amount) as fees")
                    ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
                    ->join('particulars as p', 'p.id', 'pf.particular_id')
                    ->where('p.particular_tag', '!=', 'addition_tags')
                    ->where('semestral_fees.is_removed', false)->get();
                $_other_fees =   $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
                    ->selectRaw("sum(pf.particular_amount) as fees")
                    ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
                    ->join('particulars as p', 'p.id', 'pf.particular_id')
                    ->where('p.particular_tag', '=', 'addition_tags')->get();
                $_tuition_fee =  intval($_tuition_fee[0]['fees']) + 710;
                $_monthly_fee = ($_tuition_fee - ($_tuition_fee * 0.20));
                return ($_monthly_fee / 4);
            } else {
                $_tuition_fee = $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
                    ->selectRaw("sum(pf.particular_amount) as fees")
                    ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
                    ->where('semestral_fees.is_removed', false)->get();
                $_total_fees =  ($_tuition_fee[0]->fees * .035) + $_tuition_fee[0]->fees;
                return $_total_fees / 5;
            }
        } else {
            // Full-Payment 
            // Get the Payment
            $_tuition_fee =  $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
                ->selectRaw("sum(pf.particular_amount) as fees")
                ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
                ->where('semestral_fees.is_removed', false)->get();
            return $_tuition_fee[0]->fees;
        }
    }
    public function total_payments($_data)
    {
        $_number_of_units = $_data->enrollment_assessment->course->units($_data->enrollment_assessment)->units;
        $_tuition_fees = $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', 'tuition_tags')
            ->where('semestral_fees.is_removed', false)->get();
        $_miscellaneous =  $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', '!=', 'addition_tags')
            ->where('p.particular_tag', '!=', 'tuition_tags')
            ->where('semestral_fees.is_removed', false)->get();
        $_additional_fees =   $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', '=', 'addition_tags')->get();

        if ($_data->enrollment_assessment->course_id == 3) {
            return $_data->payment_mode == 1 ? ($_tuition_fees[0]->fees + $_miscellaneous[0]->fees + $_additional_fees[0]->fees + 710) : ($_tuition_fees[0]->fees + $_miscellaneous[0]->fees + $_additional_fees[0]->fees);
        } else {
            $_total_tuition = ($_tuition_fees[0]->fees * $_number_of_units) + $_miscellaneous[0]->fees;
            $_total_tuition = $_total_tuition + ($_total_tuition * 0.035);
            return $_data->payment_mode == 1 ? $_total_tuition : (($_tuition_fees[0]->fees * $_number_of_units) + $_miscellaneous[0]->fees);
        }
    }
    public function upon_enrollment($_data)
    {
        $_number_of_units = $_data->enrollment_assessment->course->units($_data->enrollment_assessment)->units;
        $_tuition_fees = $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', 'tuition_tags')
            ->where('semestral_fees.is_removed', false)->get();
        $_miscellaneous =  $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', '!=', 'addition_tags')
            ->where('p.particular_tag', '!=', 'tuition_tags')
            ->where('semestral_fees.is_removed', false)->get();
        $_additional_fees =   $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', '=', 'addition_tags')->get();

        if ($_data->enrollment_assessment->course_id == 3) {
            return $_data->payment_mode == 1 ? (($_tuition_fees[0]->fees + $_miscellaneous[0]->fees + 710) * 0.20) + $_additional_fees[0]->fees : ($_tuition_fees[0]->fees + $_miscellaneous[0]->fees + $_additional_fees[0]->fees);
        } else {
            $_total_tuition = ($_tuition_fees[0]->fees * $_number_of_units) + $_miscellaneous[0]->fees;
            $_total_tuition = $_total_tuition + ($_total_tuition * 0.035);
            return $_data->payment_mode == 1 ? $_total_tuition / 5 : (($_tuition_fees[0]->fees * $_number_of_units) + $_miscellaneous[0]->fees);
        }
    }
    public function monthly_fees($_data)
    {
        $_number_of_units = $_data->enrollment_assessment->course->units($_data->enrollment_assessment)->units;
        $_tuition_fees = $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', 'tuition_tags')
            ->where('semestral_fees.is_removed', false)->get();
        $_miscellaneous =  $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', '!=', 'addition_tags')
            ->where('p.particular_tag', '!=', 'tuition_tags')
            ->where('semestral_fees.is_removed', false)->get();
        $_additional_fees =   $this->hasMany(SemestralFee::class, 'course_semestral_fee_id')
            ->selectRaw("sum(pf.particular_amount) as fees")
            ->join('particular_fees as pf', 'semestral_fees.particular_fee_id', 'pf.id')
            ->join('particulars as p', 'p.id', 'pf.particular_id')
            ->where('p.particular_tag', '=', 'addition_tags')->get();

        if ($_data->enrollment_assessment->course_id == 3) {
            $_total = ($_tuition_fees[0]->fees + $_miscellaneous[0]->fees + $_additional_fees[0]->fees + 710);
            $_upon_enrollment = (($_tuition_fees[0]->fees + $_miscellaneous[0]->fees + 710) * 0.20) + $_additional_fees[0]->fees;
            $_monthly_fee = ($_total - $_upon_enrollment) / 4;
            return $_data->payment_mode == 1 ? $_monthly_fee  : ($_tuition_fees[0]->fees + $_miscellaneous[0]->fees + $_additional_fees[0]->fees);
        } else {
            $_total_tuition = ($_tuition_fees[0]->fees * $_number_of_units) + $_miscellaneous[0]->fees;
            $_total_tuition = $_total_tuition + ($_total_tuition * 0.035);
            return $_data->payment_mode == 1 ? $_total_tuition / 5 : (($_tuition_fees[0]->fees * $_number_of_units) + $_miscellaneous[0]->fees);
        }
    }
}
