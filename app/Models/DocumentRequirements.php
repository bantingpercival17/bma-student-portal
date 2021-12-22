<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequirements extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'document_id', 'document_path', 'document_comments', 'document_status', 'file_path', 'staff_id', 'is_removed',];

    public function documents()
    {
        return $this->belongsTo(Documents::class, 'document_id');
    }
}
