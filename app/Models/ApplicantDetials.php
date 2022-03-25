<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantDetials extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $fillable = [
        "applicant_id",
        "first_name",
        "last_name",
        "middle_name",
        "extention_name",
        "birthday",
        "birth_place",
        "sex",
        "nationality",
        "religion",
        "civil_status",
        "street",
        "barangay",
        "municipality",
        "province",
        "zip_code",
        "father_last_name",
        "father_first_name",
        "father_middle_name",
        "father_educational_attainment",
        "father_employment_status",
        "father_working_arrangement",
        "father_contact_number",
        "mother_last_name",
        "mother_first_name",
        "mother_middle_name",
        "mother_educational_attainment",
        "mother_employment_status",
        "mother_working_arrangement",
        "mother_contact_number",
        "guardian_last_name",
        "guardian_first_name",
        "guardian_middle_name",
        "guardian_educational_attainment",
        "guardian_employment_status",
        "guardian_working_arrangement",
        "guardian_contact_number",
        'elementary_school_name',
        'elementary_school_address',
        'elementary_school_year',
        'junior_high_school_name',
        'junior_high_school_address',
        'junior_high_school_year',
        'senior_high_school_name',
        'senior_high_school_address',
        'senior_high_school_year',
        "is_removed"
    ];
}
