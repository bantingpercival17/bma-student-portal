<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Documents extends Model
{
    use HasFactory;


    public function midshipman_document()
    {
        return $this->hasOne(DocumentRequirements::class, 'document_id')
            ->where('is_removed', 0)
            ->where('student_id', Auth::user()->student_id)
            /* ->where('student_id', Auth::user()->student_id)
            ->where('is_removed', 0)
            ->first() */;
    }
}
