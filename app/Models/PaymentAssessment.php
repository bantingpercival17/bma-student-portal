<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAssessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'enrollment_id',
        'payment_mode',
        'voucher_amount',
        'total_payment',
        'staff_id',
        'is_removed',
    ];
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
    public function payment_transaction()
    {
        return $this->hasOne(PaymentTransaction::class, 'assessment_id');
    }
    public function course_semestral_fee()
    {
        return $this->belongsTo(CourseSemestralFees::class, 'course_semestral_fee_id');
    }
    public function total_payment()
    {
        return $this->hasMany(PaymentTransaction::class, 'assessment_id')->where('payment_transaction', 'TUITION FEE')->sum('payment_amount');
    }
    public function total_paid_amount()
    {
        return $this->hasMany(PaymentTransaction::class, 'assessment_id')->where('payment_transaction', 'TUITION FEE');
    }
    public function enrollment_assessment()
    {
        return $this->belongsTo(EnrollmentAssessment::class, 'enrollment_id');
    }
    public function online_transaction()
    {
        return $this->hasOne(PaymentTrasanctionOnline::class, 'assessment_id')->where('is_removed', false)->latest('id');
    }
}
