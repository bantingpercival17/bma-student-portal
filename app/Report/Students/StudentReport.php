<?php

namespace App\Report\Students;

use App\Models\EnrollmentAssessment;
use Barryvdh\DomPDF\Facade as PDF;

class StudentReport
{
    public function __construct()
    {

        $this->legal = [0, 0, 612.00, 1008.00];
    }

    public function enrollment_information($_assessment_id)
    {
        $_enrollment_assessment = EnrollmentAssessment::find($_assessment_id);
        $_student = $_enrollment_assessment->student;
        $pdf = PDF::loadView("widgets.reports.student.student_enrollment_information", compact('_student', '_enrollment_assessment'));
        $file_name = 'FORM RG-03 - ' . strtoupper($_student->last_name . ', ' . $_student->first_name . ' ' . $_student->middle_name);
        return $pdf->setPaper($this->legal, 'portrait')->stream($file_name . '.pdf');
    }
    public function applicant_form($_account)
    {

        $pdf = PDF::loadView("widgets.reports.student.student_application_form", compact('_account'));
        $file_name = 'FORM RG-03 - ' . strtoupper($_account->applicant->last_name . ', ' . $_account->applicant->first_name . ' ' . $_account->applicant->middle_name);
        return $pdf->setPaper($this->legal, 'portrait')->stream($file_name . '.pdf');
    }
}
