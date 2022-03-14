<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\DeploymentAssesment;
use App\Models\DocumentRequirements;
use App\Models\Documents;
use App\Models\EducationalDetails;
use App\Models\EnrollmentApplication;
use App\Models\ParentDetails;
use App\Models\PaymentAssessment;
use App\Models\PaymentTrasanctionOnline;
use App\Models\Role;
use App\Models\Section;
use App\Models\ShipboardJournal;
use App\Models\ShippingAgencies;
use App\Models\StudentAccount;
use App\Models\StudentDetails;
use App\Models\StudentPasswordReset;
use App\Models\SubjectClass;
use App\Models\TrainingCertificates;
use App\Report\Students\StudentReport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.home.view');
    }
    public function view_student_manual()
    {
        $_enrollment = Auth::user()->student->enrollment_assessment;
        if ($_enrollment->course_id == 3) {
            $_documents = array(asset('/assets/files/ADDENDUM-TO-THE-PROVISIONS-OF-SENIOR-HIGH-SCHOOL-HANDBOOK2020.QMR.pdf'), asset('/assets/files/SHS-Handbook.2021.QMR.pdf'));
        } else {
            $_documents = array(asset('/assets/files/ADDENDUM-TO-THE-PROVISIONS-OF-SENIOR-HIGH-SCHOOL-HANDBOOK2020.QMR.pdf'));
        }
        return view('student.home.school_handbook', compact('_documents'));
    }
    public function store_student_manual(Request $_request)
    {
        $_log_name = str_replace('@bma.edu.ph', '', Auth::user()->campus_email);
        $_log_detials = array(
            'student_id' => Auth::user()->student_id,
            'agree_statement' => $_request->status,
            'created_at' => now()
        );
        $_course = Auth::user()->student->enrollment_assessment->course->course_code;
        Storage::disk('public')->put('/student-handbook/' . $_course . '/' . $_log_name . '.json', json_encode($_log_detials));
        return back()->with('success', 'Successfully Submitted');
    }
    public function academic_view(Request $_request)
    {
        $_section = Auth::user()->student->section(Auth::user()->student->current_enrollment->academic->id)->first();
        $_subject_class = $_section ? SubjectClass::where('section_id', $_section->section_id)->where('is_removed', false)->get() : [];

        $_student = Auth::user()->student->enrollment_assessment;
        $_academic = AcademicYear::where('is_active', 1)->first();
        if ($_student->academic_id == $_academic->id) {
            return view('student.academic.view', compact('_subject_class'));
        } else {
            return view('student.academic.view', compact('_subject_class'));
            return redirect('/student/enrollment');
        }
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
            return redirect(route('enrollment'))->with('error', 'Your Already Submit Enrollment Application!');
        }
    }
    public function payment_application(Request $_request)
    {
        $_application = EnrollmentApplication::where('student_id', Auth::user()->student_id)->first();
        $_application->payment_mode = $_request->mode;
        $_application->save();
        return back()->with('success', 'Successfully Submitted.');
    }
    public function payment_store(Request $_request)
    {
        $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        $_file_path = '/public/accounting/proof_of_payments/';
        $_request->validate([
            '_transaction_date' => 'required',
            '_amount_paid' => 'required',
            '_reference_number' => 'required',
            '_transaction_type' => 'required',
            '_file' => 'required'
        ]);
        $_file = 'proof_payment';
        $_ext = $_request->_file->getClientOriginalExtension();
        $_user = str_replace('@bma.edu.ph', '', Auth::user()->campus_email);
        $_url_link =  $link . '/storage/accounting/proof_of_payments/';
        $_file_name =  $_user . "-" . strtolower('proof-of-payment' . str_replace('_', '-', $_request->_transaction_type)) . "." . $_ext;
        $_request->_file->storeAs($_file_path, $_file_name);
        //return  $_url_link . $_file_name;
        $_payment_data = array(
            'assessment_id' => base64_decode($_request->_assessment),
            'amount_paid' => str_replace(',', '', $_request->_amount_paid),
            'reference_number' => $_request->_reference_number,
            'transaction_type' => $_request->_transaction_type,
            'reciept_attach_path' => $_url_link . $_file_name,
            'is_removed' => 0
        );
        PaymentTrasanctionOnline::create($_payment_data);
        return back()->with('success', 'Successfully Submitted.');
        /* $_application = EnrollmentApplication::where('student_id', Auth::user()->student_id)->first();
        $_application->payment_mode = $_request->mode;
        $_application->save();
        return back()->with('success', 'Successfully Submitted.'); */
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
        $_input_feilds = [
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
            '_contact_number' => 'required | numeric| min:12',
            '_personal_email' => 'required',
            // Education Background
            'elementary_school_name' => 'required|max:100',
            'elementary_school_address' => 'required|max:255',
            'elementary_school_year' => 'required|max:100',
            'junior_high_school_name' => 'required|max:100',
            'junior_high_school_address' => 'required|max:255',
            'junior_high_school_year' => 'required|max:100',
        ];
        if (Auth::user()->student->current_enrollment->course_id != 3) {
            $_input_feilds += [
                'senior_high_school_name' => 'required|max:100',
                'senior_high_school_address' => 'required|max:255',
                'senior_high_school_year' => 'required|max:100',
            ];
        }
        $_input_feilds += [  // FATHER INFORMATION
            '_father_last_name' => 'required | min:2 | max:50',
            '_father_first_name' => 'required | min:2 | max:50',
            '_father_middle_name' => 'required | min:2 | max:50',
            '_father_educational_attainment' => 'required | min:2 | max:100',
            '_father_employment_status' => 'required | min:2 | max:50',
            '_father_working_arrangement' => 'required | min:2 | max:50',
            '_father_contact_number' => 'required| min:2 | max:12',
            // MOTHER INFORMATION
            '_mother_last_name' => 'required | min:2 | max:50',
            '_mother_first_name' => 'required | min:2 | max:50',
            '_mother_middle_name' => 'required | min:2 | max:50',
            '_mother_educational_attainment' => 'required | min:2 | max:100',
            '_mother_employment_status' => 'required | min:2 | max:50',
            '_mother_working_arrangement' => 'required | min:2 | max:50',
            '_mother_contact_number' => 'required | min:2 | max:12',
            // GUARDIAN  INFORMATION
            '_guardian_last_name' => 'required | min:2 | max:50',
            '_guardian_first_name' => 'required | min:2 | max:50',
            '_guardian_middle_name' => 'required | min:2 | max:50',
            '_guardian_educational_attainment' => 'required | min:2 | max:50',
            '_guardian_employment_status' => 'required | min:2 | max:50',
            '_guardian_working_arrangement' => 'required | min:2 | max:50',
            '_guardian_contact_number' => 'required| min:2 | max:12',
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
        ];
        $_request->validate($_input_feilds);
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
            'street' => ucwords(mb_strtolower(trim($_request->_street))),
            'barangay' => ucwords(mb_strtolower(trim($_request->_barangay))),
            'municipality' => ucwords(mb_strtolower(trim($_request->_municipality))),
            'province' => ucwords(mb_strtolower(trim($_request->_province))),
            'zip_code' => trim(ucwords(mb_strtolower($_request->_zip_code))),
            'contact_number' => $_request->_contact_number,
        );
        StudentDetails::where('id', Auth::user()->student_id)->update($_student_details);
        $_account_details = array(
            'personal_email' => trim(mb_strtolower($_request->_personal_email))
        );
        StudentAccount::where('student_id', Auth::user()->student_id)->update($_account_details);
        if (count(Auth::user()->student->educational_details) > 0) {
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
            if (Auth::user()->student->current_enrollment->course_id != 3) {
                $_edu_details = EducationalDetails::where('student_id', Auth::user()->student_id)->where('school_level', 'Senior High School')->first();
                $_edu_details->school_name = trim(ucwords(mb_strtolower($_request->senior_high_school_name)));
                $_edu_details->school_address = trim(ucwords(mb_strtolower($_request->senior_high_school_address)));
                $_edu_details->graduated_year = trim(ucwords(mb_strtolower($_request->senior_high_school_year)));
                $_edu_details->save();
            }
        } else {
            $_education = array(
                'student_id' => Auth::user()->student_id,
                'school_level' => 'Elementary School',
                'school_name' => trim(ucwords(mb_strtolower($_request->elementary_school_name))),
                'school_address' => trim(ucwords(mb_strtolower($_request->elementary_school_address))),
                'graduated_year' =>  trim(ucwords(mb_strtolower($_request->elementary_school_year))),
                "school_category" => 'n/a',
                "is_removed" => false
            );
            EducationalDetails::create($_education); // Elem
            $_education = array(
                'student_id' => Auth::user()->student_id,
                'school_level' => 'Junior High School',
                'school_name' => trim(ucwords(mb_strtolower($_request->junior_high_school_name))),
                'school_address' => trim(ucwords(mb_strtolower($_request->junior_high_school_address))),
                'graduated_year' =>  trim(ucwords(mb_strtolower($_request->junior_high_school_year))),
                "school_category" => 'n/a',
                "is_removed" => false
            );
            EducationalDetails::create($_education); // Junior Highschool
            if (Auth::user()->student->current_enrollment->course_id != 3) {
                $_education = array(
                    'student_id' => Auth::user()->student_id,
                    'school_level' => 'Senior High School',
                    'school_name' => trim(ucwords(mb_strtolower($_request->senior_high_school_name))),
                    'school_address' => trim(ucwords(mb_strtolower($_request->senior_high_school_address))),
                    'graduated_year' =>  trim(ucwords(mb_strtolower($_request->senior_high_school_year))),
                    "school_category" => 'n/a',
                    "is_removed" => false
                );
                EducationalDetails::create($_education); // Senior Highshcool
            }
        }/* Educational Details */

        /* Parent Details */
        $_parent_details = Auth::user()->student->parent_details;
        $_parent_info = array(
            "father_last_name" => trim(ucwords(mb_strtolower($_request->_father_last_name))),
            "father_first_name" => trim(ucwords(mb_strtolower($_request->_father_first_name))),
            "father_middle_name" => trim(ucwords(mb_strtolower($_request->_father_middle_name))),
            "father_educational_attainment" => $_request->_father_educational_attainment,
            "father_employment_status" => $_request->_father_employment_status,
            "father_working_arrangement" => $_request->_father_working_arrangement,
            "father_contact_number" => $_request->_father_contact_number,

            "mother_last_name" => trim(ucwords(mb_strtolower($_request->_mother_last_name))),
            "mother_first_name" => trim(ucwords(mb_strtolower($_request->_mother_first_name))),
            "mother_middle_name" => trim(ucwords(mb_strtolower($_request->_mother_middle_name))),
            "mother_educational_attainment" => $_request->_mother_educational_attainment,
            "mother_employment_status" => $_request->_mother_employment_status,
            "mother_working_arrangement" => $_request->_mother_working_arrangement,
            "mother_contact_number" => $_request->_mother_contact_number,

            "guardian_last_name" => trim(ucwords(mb_strtolower($_request->_guardian_last_name))),
            "guardian_first_name" => trim(ucwords(mb_strtolower($_request->_guardian_first_name))),
            "guardian_middle_name" => trim(ucwords(mb_strtolower($_request->_guardian_middle_name))),
            "guardian_educational_attainment" => $_request->_guardian_educational_attainment,
            "guardian_employment_status" => $_request->_guardian_employment_status,
            "guardian_working_arrangement" => $_request->_guardian_working_arrangement,
            "guardian_contact_number" => $_request->_guardian_contact_number,

            'household_income' => $_request->_household_income,
            'dswd_listahan' => $_request->_dswd_listahan,
            'homeownership' => $_request->_homeownership,
            'car_ownership' => $_request->_car_ownership,

            'available_devices' => serialize($_request->_devices),
            'available_connection' => $_request->_connection,
            'available_provider' => serialize($_request->_provider),
            'learning_modality' => serialize($_request->_learning_modality),
            'distance_learning_effect' => serialize($_request->_inputs)
        );
        if ($_parent_details) {
            ParentDetails::find($_parent_details->id)->update($_parent_info);
        } else {
            $_parent_details = array(
                'student_id' => Auth::user()->student->id,
                "father_last_name" => trim(ucwords(mb_strtolower($_request->_father_last_name))),
                "father_first_name" => trim(ucwords(mb_strtolower($_request->_father_first_name))),
                "father_middle_name" => trim(ucwords(mb_strtolower($_request->_father_middle_name))),
                "father_educational_attainment" => $_request->_father_educational_attainment,
                "father_employment_status" => $_request->_father_employment_status,
                "father_working_arrangement" => $_request->_father_working_arrangement,
                "father_contact_number" => $_request->_father_contact_number,

                "mother_last_name" => trim(ucwords(mb_strtolower($_request->_mother_last_name))),
                "mother_first_name" => trim(ucwords(mb_strtolower($_request->_mother_first_name))),
                "mother_middle_name" => trim(ucwords(mb_strtolower($_request->_mother_middle_name))),
                "mother_educational_attainment" => $_request->_mother_educational_attainment,
                "mother_employment_status" => $_request->_mother_employment_status,
                "mother_working_arrangement" => $_request->_mother_working_arrangement,
                "mother_contact_number" => $_request->_mother_contact_number,

                "guardian_last_name" => trim(ucwords(mb_strtolower($_request->_guardian_last_name))),
                "guardian_first_name" => trim(ucwords(mb_strtolower($_request->_guardian_first_name))),
                "guardian_middle_name" => trim(ucwords(mb_strtolower($_request->_guardian_middle_name))),
                "guardian_educational_attainment" => $_request->_guardian_educational_attainment,
                "guardian_employment_status" => $_request->_guardian_employment_status,
                "guardian_working_arrangement" => $_request->_guardian_working_arrangement,
                "guardian_contact_number" => $_request->_guardian_contact_number,

                'household_income' => $_request->_household_income,
                'dswd_listahan' => $_request->_dswd_listahan,
                'homeownership' => $_request->_homeownership,
                'car_ownership' => $_request->_car_ownership,

                'available_devices' => serialize($_request->_devices),
                'available_connection' => $_request->_connection,
                'available_provider' => serialize($_request->_provider),
                'learning_modality' => serialize($_request->_learning_modality),
                'distance_learning_effect' => serialize($_request->_inputs)
            );
            ParentDetails::create($_parent_details);
        }
        //return compact('_account_details');
        return redirect(route('academic.clearance'))->with('success', 'Successfullly Update your Student Profile.');
    }

    public function grades_view(Request $_request)
    {
        return view('student.grades.view');
    }
    public function payments_view(Request $_request)
    {
        $_student = Auth::user()->student;
        //$_course_semestral_fee = $_student->enrollment_assessment->payment_assessments->course_semestral_fee;
        $_payment_details = $_request->_payment_assessment  ? PaymentAssessment::find(base64_decode($_request->_payment_assessment)) : $_student->enrollment_assessment->payment_assessments;
        return view('student.payments.view', compact('_payment_details', '_student'));
    }

    public function onboard_view(Request $_request)
    {
        $_certificates = TrainingCertificates::where('is_removed', 1)->orderByRaw('CHAR_LENGTH("training_name")')->get();
        $_documents = Documents::where('is_removed', 1)->where('document_propose', 'PRE-DEPLOYMENT')->orderByRaw('CHAR_LENGTH("document_name")')->get();
        $_assess = DeploymentAssesment::where('student_id', Auth::user()->student_id)->where('is_removed', 0)->first();
        $_document_requirement = DocumentRequirements::where('student_id', Auth::user()->student_id)->where('is_removed', 0)->get();
        $_agency = ShippingAgencies::where('is_removed', 1)->get();
        $_journal = ShipboardJournal::select('month', DB::raw('count(*) as total'))->where('student_id', Auth::user()->student_id)->where('is_removed', false)->groupBy('month')->get();
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

        /* $_input_feilds = $_request->validate([
            '_month' => 'required',
            '_trb_remark' => 'required',
            '_journal_remark' => 'required',
            '_trb_documents.*' => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
            '_journal_documents.*' => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
            '_crew_list.*' => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
            '_mdsd.*'  => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
            '_while_at_work.*'  => 'required|mimes:png,docs,docx,jpeg,jpg,pdf|max:10000',
        ]); */
        $_input_feilds = $_request->validate([
            '_month' => 'required',
            '_trb_remark' => 'required',
            '_journal_remark' => 'required',
            '_trb_documents' => 'required',
            '_journal_documents' => 'required',
            '_crew_list' => 'required',
            '_mdsd'  => 'required',
            '_while_at_work'  => 'required',
        ]);
        $_user = str_replace('@bma.edu.ph', '', Auth::user()->campus_email);
        $_narative_details = [
            ['Training Record Book', '_trb_documents', '_trb_remark'],
            ['Daily Journal', '_journal_documents', '_journal_remark'],
            ['Crew List', '_crew_list'],
            ["Master's Declaration of Safe Departure", '_mdsd'],
            ['Picture while at work', '_while_at_work']
        ];
        foreach ($_narative_details as $key => $details) {

            $_data_narative = array(
                'student_id' => Auth::user()->student->id,
                'month' => $_request->_month,
                'file_links' => $_request->input($details[1]),
                'journal_type' => $details[0],
                'remark' => count($details) > 2 ? $_input_feilds[$details[2]] : null,
                'is_removed' => false,
            );
            ShipboardJournal::create($_data_narative);
        }
        //return dd($_data_narative);
        return redirect('/student/on-board/journal/view?_j=' . base64_encode($_request->_month))->with('success', 'Successfully Created Journal');
    }
    public function recent_upload_journal_file(Request $_request)
    {
        $_data = array(
            'student_id' => Auth::user()->student->id,
            'month' => base64_decode($_request->_month),
            'journal_type' => $_request->_name,
            'is_removed' => 0
        );
        $_journal = ShipboardJournal::where($_data)->first();

        if (!$_journal) {
            $_data['file_links'] = $_request->_file_url;
            $_data['remark'] = $_request->_remarks;
            //return $_data;
            ShipboardJournal::create($_data);
            return back()->with('success', 'Successfully Upload');
        } else {
            # code...
        }

        return $_request;
        //
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
    public function upload_journal_file(Request $_request)
    {
        $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        $_user = str_replace('@bma.edu.ph', '', Auth::user()->campus_email);
        $_url_link =  $link . '/storage/onboard/shipboard-journal/' . $_user . '/';
        $_file_path = '/public/onboard/shipboard-journal/' . $_user . '/';
        $file = $_request->file('file');
        $_user = str_replace('@bma.edu.ph', '', Auth::user()->campus_email);
        $_date = date('dmYhms');
        $_file_name = '[' . $_user . ']' . $_request->_documents . '_' . $_request->_file_number . $_date . "." . $file->getClientOriginalExtension(); // Set a File name with Username and the Original File name
        $file->storeAs($_file_path, $_file_name); // Store the File to the Folder
        $_file_links = $_url_link . $_file_name; // Get the Link of the Files
        return  $_file_links;
    }
    public function remove_journal(Request $_request)
    {
        //return base64_decode($_request->_journal);
        ShipboardJournal::where('month', base64_decode($_request->_journal))
            ->where('student_id', Auth::user()->student->id)
            ->where('is_removed', 0)
            ->update(['is_removed' => true]);
        return redirect('student/on-board')->with('success', 'Narative Report Successfully Removed');
    }
    public function account_view()
    {
        return view('student.home.account_view');
    }
    public function student_change_password(Request $_request)
    {
        $_request->validate([
            'password' => ['required', 'confirmed'],
        ]);
        $_account = StudentAccount::find(base64_decode($_request->account));
        $_account->password = Hash::make($_request->password);
        $_account->save();
        StudentPasswordReset::create([
            'student_id' => $_account->student_id,
            'password_string' => $_request->password,
            'is_status' => 'change-password',
            'is_removed' => false,
        ]);

        return back()->with('success', 'Successsfully Change your Password');
    }
    public function enrollment_report_view()
    {
        $_student_report = new StudentReport();;
        $_student = Auth::user()->student->enrollment_assessment;
        return $_student_report->enrollment_information($_student->id);
    }
}
