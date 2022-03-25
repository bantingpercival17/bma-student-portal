<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipboardJournal extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'month',
        'remark',
        'file_links',
        'journal_type',
        'is_removed',
    ];
    /*  'student_id' => Auth::user()->student->id,
            'month' => $_request->_month,
            'remark' => $_request->_journal_remark,
            'file_links' => json_encode($_files),
            'journal_type' => 'journal',
            'is_removed' => false, */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
