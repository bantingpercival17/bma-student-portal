<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationQuestion extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'category_id',
        'question',
        'image_path',
        'score'
    ];
    public function questions()
    {
        return $this->belongsTo(ExaminationCategory::class, 'category_id');
    }
    public function choices()
    {
        return $this->hasMany(ExaminationQuestionChoice::class, 'question_id')->orderBy('choice_name', 'asc')->where('is_removed', 0);
    }
}
