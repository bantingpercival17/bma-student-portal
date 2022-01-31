<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\DeploymentAssesment;
use App\Models\DocumentRequirements;
use App\Models\Documents;
use App\Models\EducationalDetails;
use App\Models\EnrollmentApplication;
use App\Models\Role;
use App\Models\Section;
use App\Models\ShipboardJournal;
use App\Models\ShippingAgencies;
use App\Models\StudentAccount;
use App\Models\StudentDetails;
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
        $_up_comming_academic = AcademicYear::where('is_active', 1)->first();

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

    public function view_student_profile(Request $_request)
    {
        return view('student.home.student_profile_form');
    }
    public function update_student_profile(Request $_request)
    {
        $_request->validate([
            '_first_name' => 'required',
            '_last_name' => 'required',
            '_middle_name' => 'required | min:3',
            '_extension_name' => 'required | min:2',
            '_birthday' => 'required',
            '_birth_place' => 'required',
            '_civil_status' => 'required',
            '_religion' => 'required',
            '_nationality' => 'required',
            '_street' => 'required',
            '_barangay' => 'required',
            '_municipality' => 'required',
            '_province' => 'required',
            '_zip_code' => 'required',
            '_contact_number' => 'required',
            '_personal_email' => 'required',
            'elementary_school_name' => 'required|max:100',
            'elementary_school_address' => 'required|max:255',
            'elementary_school_year' => 'required|max:100',
            'junior_high_school_name' => 'required|max:100',
            'junior_high_school_address' => 'required|max:255',
            'junior_high_school_year' => 'required|max:100',
        ]);
        /* $_request->validate([
            '_first_name' => 'required',
            '_last_name' => 'required',
            '_middle_name' => 'required',
            '_extension_name' => 'required',
            '_birthday' => 'required',
            '_birth_place' => 'required',
            '_street' => 'required',
            '_barangay' => 'required',
            '_city' => 'required',
            '_province' => 'required',
            '_zip_code' => 'required',
            '_contact_number' => 'required',
            '_civil_status' => 'required',
            '_religion' => 'required',
            '_nationality' => 'required',
            // Educational Background
            '_elem_school' => 'required | max:100',
            '_elem_year' => 'required | numeric',
            '_elem_address' => 'required | max:255',
            '_junior_high_school' => 'required | max:100',
            '_junior_high_year' => 'required | numeric',
            '_junior_high_address' => 'required | max:255',
            '_senior_high_school' => 'required | max:100',
            '_senior_high_year' => 'required | numeric',
            '_senior_high_address' => 'required | max:255',
            // FATHER INFORMATION
            '_father_last_name' => 'required | min:2 | max:50',
            '_father_first_name' => 'required | min:2 | max:50',
            '_father_middle_name' => 'required | min:2 | max:50',
            '_father_educational_attainment' => 'required | min:2 | max:100',
            '_father_employment_status' => 'required | min:2 | max:50',
            '_father_working_arrangement' => 'required | min:2 | max:50',
            '_father_contact_number' => 'required',
            // MOTHER INFORMATION
            '_mother_last_name' => 'required | min:2 | max:50',
            '_mother_first_name' => 'required | min:2 | max:50',
            '_mother_middle_name' => 'required | min:2 | max:50',
            '_mother_educational_attainment' => 'required | min:2 | max:100',
            '_mother_employment_status' => 'required | min:2 | max:50',
            '_mother_working_arrangement' => 'required | min:2 | max:50',
            '_mother_contact_number' => 'required',
            // GUARDIAN  INFORMATION
            '_guadian_last_name' => 'required | min:2 | max:50',
            '_guadian_first_name' => 'required | min:2 | max:50',
            '_guadian_middle_name' => 'required | min:2 | max:50',
            '_guadian_educational_attainment' => 'required | min:2 | max:50',
            '_guadian_employment_status' => 'required | min:2 | max:50',
            '_guadian_working_arrangement' => 'required | min:2 | max:50',
            '_guadian_contact_number' => 'required',
            // OTHER DETIALS
            '_household_income' => 'required',
            '_dswd_listahan' => 'required',
            '_homeownership' => 'required',
            '_car_ownership' => 'required',
            // Access 
            '_devices' => 'required',
            '_connection' => 'required',
            '_provider' => 'required',
            '_learning_modality' => 'required',
            '_inputs' => 'required'
        ]); */
        $_student_details = array(
            'last_name' => trim(ucwords(mb_strtolower($_request->_last_name))),
            'first_name' => trim(ucwords(mb_strtolower($_request->_first_name))),
            'middle_name' => trim(ucwords(mb_strtolower($_request->_middle_name))),
            'extention_name' => $_request->_extension_name,
            'birthday' => $_request->_birthday,
            'birth_place' => trim(ucwords(mb_strtolower($_request->_birth_place))),
            'civil_status' => trim(ucwords(mb_strtolower($_request->_civil_status))),
            'religion' => trim(ucwords(mb_strtolower($_request->_religion))),
            'nationality' => trim(ucwords(mb_strtolower($_request->_nationality))),
            'street' => trim(ucwords(mb_strtolower($_request->_street))),
            'barangay' => trim(ucwords(mb_strtolower($_request->_barangay))),
            'municipality' => trim(ucwords(mb_strtolower($_request->_municipality))),
            'province' => trim(ucwords(mb_strtolower($_request->_province))),
            'zip_code' => trim(ucwords(mb_strtolower($_request->_zip_code))),
            'contact_number' => $_request->_contact_number,
        );
        StudentDetails::where('id', Auth::user()->student_id)->update($_student_details);
        $_account_details = array(
            'personal_email' => trim(mb_strtolower($_request->_personal_email))
        );
        StudentAccount::where('student_id', Auth::user()->student_id)->update($_account_details);
        $_edu_details = EducationalDetails::where('student_id', Auth::user()->student_id)->where('school_level', 'Elementary School')->first();
        $_edu_details->school_name = trim(ucwords(mb_strtolower($_request->elementary_school_name)));
        $_edu_details->school_address = trim(ucwords(mb_strtolower($_request->elementary_school_address)));
        $_edu_details->graduated_year = trim(ucwords(mb_strtolower($_request->elementary_school_year)));
        $_edu_details->save();
        $_edu_details = EducationalDetails::where('student_id', Auth::user()->student_id)->where('school_level', 'Junior High School')->first();
        $_edu_details->school_name = trim(ucwords(mb_strtolower($_request->junior_high_school_name)));
        $_edu_details->school_address = trim(ucwords(mb_strtolower($_request->junior_high_school_address)));
        $_edu_details->graduated_year = trim(ucwords(mb_strtolower($_request->junior_high_school_year)));
        $_edu_details->save();
        //return compact('_account_details');
        return back()->with('success', 'Successfullly Update your Student Profile.');
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
