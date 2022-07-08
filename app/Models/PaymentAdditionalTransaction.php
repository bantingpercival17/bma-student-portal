<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAdditionalTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'enrollment_id',
        'amount_paid',
        'reference_number',
        'transaction_type',
        'reciept_attach_path',
        'is_approved',
        'transaction_date',
        'comment_remarks',
        'or_number',
        'is_removed'
    ];
}
