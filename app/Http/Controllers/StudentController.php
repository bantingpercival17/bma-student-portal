<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\DeploymentAssesment;
use App\Models\DocumentRequirements;
use App\Models\Documents;
use App\Models\EnrollmentApplication;
use App\Models\Role;
use App\Models\Section;
use App\Models\ShipboardJournal;
use App\Models\ShippingAgencies;
use App\Models\SubjectClass;
use App\Models\TrainingCertificates;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.home.view');
    }

    public function academic_view(Request $_request)
    {
        $_section = Auth::user()->student->section(Auth::user()->student->current_enrollment->academic->id)->first();
        $_subject_class = $_section ? SubjectClass::where('section_id', $_section->section_id)->where('is_removed', false)->get() : [];
        return view('student.academic.view', compact('_subject_class'));
    }
    public function academic_grades(Request $_request)
    {
        $_section = Auth::user()->student->section(Auth::user()->student->current_enrollment->academic->id)->first();
        $_subject_class = $_section ? SubjectClass::where('section_id', $_section->section_id)->where('is_removed', false)->get() : [];
        return view('student.academic.grades', compact('_subject_class'));
    }
    public function academic_clearance(Request $_request)
    {
        $_section = Auth::user()->student->section(Auth::user()->student->current_enrollment->academic->id)->first();
        $_subject_class = $_section ? SubjectClass::where('section_id', $_section->section_id)->where('is_removed', false)->get() : [];
        $_roles = Role::get();
        return view('student.academic.clearance', compact('_subject_class', '_roles'));
    }


    /* Enrollment */
    public function enrollment_application()
    {
        $_up_comming_academic = AcademicYear::where('is_active', 2)->first();

        $_enrollment_application = EnrollmentApplication::where(['student_id' => Auth::user()->student_id, 'academic_id' => $_up_comming_academic->id])->first();
        if (!$_enrollment_application) {
            $_details = [
                'student_id' => Auth::user()->student_id,
                'academic_id' => $_up_comming_academic->id,
                'enrollment_place' => 'online',
                'is_removed' => false,
            ];

            EnrollmentApplication::create($_details);
            return redirect(route('enrollment'))->with('success', 'Successfully Send your Enrollment Application!');
        } else {
            return back()->with('error', 'Your Already Submit Enrollment Application!');
        }
    }
    public function enrollment_view()
    {
        return view('student.enrollment.view');
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
        $_journal = ShipboardJournal::select('month', DB::raw('count(*) as total'))->where('student_id', Auth::user()->student_id)->groupBy('month')->get();
        return view('student.onboard.view', compact('_certificates', '_documents', '_agency', '_assess', '_document_requirement', '_journal'));
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
    public function create_journal()
    {
        return view('student.onboard.journal_create');
    }
    public function store_journal(Request $_request)
    {
        $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        $_file_path = '/public/onboard/shipboard-journal/';
        $_input_feilds = $_request->validate([
            '_month' => 'required',
            '_trb_remark' => 'required',
            '_journal_remark' => 'required',
            '_trb_documents.*' => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
            '_journal_documents.*' => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
            '_crew_list.*' => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
            '_mdsd.*'  => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
            '_while_at_work.*'  => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
        ]);
        $_file_path = '/public/onboard/shipboard-journal/';
        $_user = str_replace('@bma.edu.ph', '', Auth::user()->campus_email);
        $_url_link =  $link . '/storage/onboard/shipboard-journal/';
        $_narative_details = [
            ['Training Record Book', '_trb_documents', '_trb_remark'],
            ['Daily Journal', '_journal_documents', '_journal_remark'],
            ['Crew List', '_crew_list'],
            ["Master's Declaration of Safe Departure", '_mdsd'],
            ['Picture while at work', '_while_at_work']
        ];
        foreach ($_narative_details as $key => $details) {
            $_file_links = [];
            foreach ($_request->file($details[1]) as $key => $file) {
                $_file_name = '[' . $_user . ']' . $file->getClientOriginalName(); // Set a File name with Username and the Original File name
                $file->storeAs($_file_path, $_file_name); // Store the File to the Folder
                $_file_links[] = $_url_link . $_file_name; // Get the Link of the Files
            }
            $_month = $_request->_month > 9 ? '-' . $_request->_month : '-0' . $_request->_month; // Get the Month
            $_data_narative = array(
                'student_id' => Auth::user()->student->id,
                'month' =>  date('Y') . $_month . "-" . date('d'),
                'file_links' => json_encode($_file_links),
                'journal_type' => $details[0],
                'remark' => count($details) > 2 ? $_input_feilds[$details[2]] : null,
                'is_removed' => false,
            );
            ShipboardJournal::create($_data_narative);
        }
        return redirect('/student/on-board/journal/view?_j=' . base64_encode(date('Y') . $_month . "-" . date('d')))->with('success', 'Successfully Created Journal');
    }
    public function view_journal(Request $_request)
    {
        $_journal = ShipboardJournal::where([
            'student_id' => Auth::user()->student->id,
            'month' => base64_decode($_request->_j),
            'is_removed' => false
        ])->get();
        $_journals = ShipboardJournal::select('month', DB::raw('count(*) as total'))->where('student_id', Auth::user()->student_id)->groupBy('month')->get();

        return view('student.onboard.journal_view', compact('_journal', '_journals'));
    }
}
