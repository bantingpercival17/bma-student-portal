<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\DeploymentAssesment;
use App\Models\DocumentRequirements;
use App\Models\Documents;
use App\Models\ShippingAgencies;
use App\Models\TrainingCertificates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.home.view');
    }

    public function academic_view(Request $_request)
    {
        $_academic = AcademicYear::all();
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
        $_certificates = TrainingCertificates::where('is_removed', 1)->orderByRaw('CHAR_LENGTH("training_name")')->get();
        $_documents = Documents::where('is_removed', 1)->where('document_propose', 'PRE-DEPLOYMENT')->orderByRaw('CHAR_LENGTH("document_name")')->get();
        $_assess = DeploymentAssesment::where('student_id', Auth::user()->student_id)->where('is_removed', 0)->first();
        $_document_requirement = DocumentRequirements::where('student_id', Auth::user()->student_id)->where('is_removed', 0)->get();
        $_agency = ShippingAgencies::where('is_removed', 1)->get();
        return view('student.onboard.view', compact('_certificates', '_documents', '_agency', '_assess', '_document_requirement'));
    }
    public function onboard_pre_deployment_store(Request $_request)
    {
        $_documents = Documents::where('is_removed', 1)->where('document_propose', 'PRE-DEPLOYMENT')->orderByRaw('CHAR_LENGTH("document_name")')->get();
        $_validate = [];
        $_validate['_agency'] =  'required';
        foreach ($_documents as $_docu) {
            $_validate[strtolower(str_replace(' ', '_', $_docu->document_name))] =  'required';
        }
        $_inputs =  $_request->validate($_validate); // validate Inputs
        // Save Deployment Assessment
        $_deployment_application = DeploymentAssesment::where('student_id', Auth::user()->student->id)->where('is_removed', 0)->first();
        if (!$_deployment_application) {
            DeploymentAssesment::create([
                'student_id'  => Auth::user()->student->id,
                'agency_id' => $_request->_agency,
                'is_removed' => 0
            ]);
        }
        //return $_inputs['_agency'];
        foreach ($_documents as $_docu) {
            $_file =  $_inputs[strtolower(str_replace(' ', '_', $_docu->document_name))];
            $_ext = $_file->getClientOriginalExtension();
            $_user = str_replace('@bma.edu.ph', '', Auth::user()->campus_email);
            $_file_name =  $_user . "-" . strtolower(str_replace(' ', '-', $_docu->document_name)) . "." . $_ext;
            $_file_path = '/public/onboard/pre-documents/';
            $_file->storeAs($_file_path, $_file_name);
            $_document_detials = array(
                'document_id' => $_docu->id,
                'student_id' => Auth::user()->student_id,
                'document_path' => $_file_path . $_file_name,
                'file_path' => $_file_path . $_file_name,
                'document_status' => 0,
                'is_removed' => 0
            );
            DocumentRequirements::create($_document_detials);
        }

        return back();
    }
}
