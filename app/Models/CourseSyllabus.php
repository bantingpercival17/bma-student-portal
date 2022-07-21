<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSyllabus extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'course_id',
        'course_description',
        'prerequisite',
        'co_requisite',
        'semester',
        'creator_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id')->where('is_removed', false);
    }
    public function stcw_reference()
    {
        return $this->hasMany(SyllabusStcwReference::class, 'course_syllabus_id')->where('is_removed', false);
    }
    public function course_outcome()
    {
        return $this->hasMany(SyllabusCourseOutcome::class, 'course_syllabus_id')->where('is_removed', false);
    }
    public function details()
    {
        return $this->hasOne(SyllabusCourseDetails::class, 'course_syllabus_id')->where('is_removed', false);
    }
    public function learning_outcomes()
    {
        return $this->hasMany(SyllabusCourseLearningOutcome::class, 'course_syllabus_id')->where('is_removed', false);
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'creator_id');
    }
    public function ict()
    {
        return [
            [
                'course_objective' => 'CO1: Effectively use computer applicants for documents used onboard ship',
                'learning_outcome' => [
                    [
                        'lo' => 'LO1.1: Explain the Fundamentals of Data Processing',
                        'presentation' => 'https://docs.google.com/presentation/d/e/2PACX-1vQTmpJVC8u8cGdPU_9jimbWNzL1KxoJu_bC2yiKBM5-qVKbTq7ONaBRw-9XeA2Kvg/embed?start=false&loop=false',
                        'topic' => 'Topic 1 : Fundamentals of Data processing',
                        // 'assessment' => 'Assessment : Quiz'
                    ],
                    [
                        'lo' => 'LO1.2: Operate computer system and other related computer applications fir documents used onboard ship',
                        'topic' => 'Topic 2 : System Software'

                    ]
                ]

            ],
            [
                'course_objective' => 'CO2: Evaluate computer networks used on board ships in terms of modularity and expandability',
                'learning_outcome' => [
                    [
                        'lo' => 'LO2.1: Explain different physical parts of a computer system used in computer networks',
                        'topic' => 'Topic 3 : Hardware and Systems Technology Basics'
                    ],
                    [
                        'lo' => 'LO2.2: Determine different network typologies used in network design',
                        'topic' => 'Topic 4. Computer Networks on Ships'
                    ]
                ]
            ],
            [
                'course_objective' => 'CO3. Troubleshoot computer as per manufacturer’s instructions.',
                'learning_outcome' => [
                    [
                        'lo' => 'LO3.1:Determine different hardware, software and network problems usually encountered in using computer applications',
                        'topic' => 'Topic 3 : Hardware and Systems Technology Basics'
                    ],
                    [
                        'lo' => 'LO2.2: Determine different network typologies used in network design',
                        'topic' => 'Topic 4. Computer Networks on Ships'
                    ]
                ]

            ],

        ];
    }
}
