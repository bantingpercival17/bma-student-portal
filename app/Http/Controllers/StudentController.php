<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.home.view');
    }

    public function academic_view(Request $_request)
    {
        return view('student.academic.view');
    }
    public function grades_view(Request $_request)
    {
        return view('student.grades.view');
    }
    public function payments_view(Request $_request)
    {
        return view('student.payments.view');
    }

    public function onboard_view(Request $_request)
    {
        return view('student.onboard.view');
    }
}
