<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\CourseSyllabus;
use App\Models\DeploymentAssesment;
use App\Models\DocumentRequirements;
use App\Models\Documents;
use App\Models\EducationalDetails;
use App\Models\EnrollmentApplication;
use App\Models\Examination;
use App\Models\ParentDetails;
use App\Models\PaymentAssessment;
use App\Models\PaymentTrasanctionOnline;
use App\Models\Role;
use App\Models\Section;
use App\Models\ShipboardExamination;
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
        return view('pages.student.home.view');
    }
    public function view_student_manual()
    {
        $_enrollment = Auth::user()->student->enrollment_assessment;
        if ($_enrollment->course_id == 3) {
            $_documents = array(asset('/assets/files/ADDENDUM-TO-THE-PROVISIONS-OF-SENIOR-HIGH-SCHOOL-HANDBOOK2020.QMR.pdf'), asset('/assets/files/SHS-Handbook.2021.QMR.pdf'));
        } else {
            $_documents = array(asset('/assets/files/BMA-Midshipman-Handbook-Draft-June-18-2021-1.pdf'));
        }
        return view('pages.student.home.school_handbook', compact('_documents'));
    }
    public function store_student_manual(Request $_request)
    {
        $_log_name = str_replace('@bma.edu.ph', '', Auth::user()->campus_email);
        $_course = Auth::user()->student->enrollment_assessment->course->course_code;
        $_log_detials = array(
            'student_id' => Auth::user()->student_id,
            'agree_statement' => $_request->status,
            'created_at' => now()
        );
        $_course_log_name = '/student-handbook/' . $_course . '/' . $_course . '.json';
        $_array_log = Storage::disk('public')->exists($_course_log_name) ? json_decode(Storage::disk('public')->get($_course_log_name)) : [];
        array_push($_array_log, $_log_detials);
        Storage::disk('public')->put($_course_log_name, json_encode($_array_log));
        Storage::disk('public')->put('/student-handbook/' . $_course . '/' . $_log_name . '.json', json_encode($_log_detials));
        return back()->with('success', 'Successfully Submitted');
    }
    function store(Request $request)
    {
        try {
            // my data storage location is project_root/storage/app/data.json file.
            $contactInfo = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];
            $inputData = $request->only(['name', 'email', 'message', 'subject']);
            $inputData['datetime_submitted'] = date('Y-m-d H:i:s');
            array_push($contactInfo, $inputData);
            Storage::disk('local')->put('data.json', json_encode($contactInfo));
            return $inputData;
        } catch (Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    public function academic_view(Request $_request)
    {
        try {
            $_student = Auth::user()->student;
            $_section = Auth::user()->student->section;
            $_enrollment_assessment = Auth::user()->student->enrollment_assessment;
            $_section = $_student->section()->first();
            $_subject_class = $_section ? SubjectClass::where('section_id', $_section->section_id)->where('is_removed', false)->get() : [];
            return view('pages.student.academic.view', compact('_subject_class'));
        } catch (Exception $error) {
            return back()->with('error', $error->getMessage());
        }
    }
    public function academic_grades(Request $_request)
    {
        $_section = Auth::user()->student->section;
        //return $_section->section;
        $_subject_class = $_section ? SubjectClass::where('section_id', $_section->section_id)->where('is_removed', false)->get() : [];
        $_student = Auth::user()->student;
        return view('pages.student.academic.grades', compact('_section', '_student'));
    }
    public function academic_clearance(Request $_request)
    {
        $_section = Auth::user()->student->section(Auth::user()->student->current_enrollment->academic->id)->first();
        $_subject_class = $_section ? SubjectClass::where('section_id', $_section->section_id)->where('is_removed', false)->get() : [];
        $_roles = Role::get();
        return view('pages.student.academic.clearance', compact('_subject_class', '_roles'));
    }
    public function academic_subject_class(Request $_request)
    {
        //return Hash::make('dejesusrickjan');
        try {
            $_course_syllabus = new CourseSyllabus();
            $_subject_class = SubjectClass::find(base64_decode($_request->_subject));
            $_subject_code =  $_subject_class->curriculum_subject->subject->subject_code;

            if ($_subject_code == 'ICT') {
                $_subject_content = $_course_syllabus->ict();
            } else {
                $_subject_content = [];
            }
            //return $_subject_content;
            return view('pages.student.academic.subject-content', compact('_subject_content', '_subject_class'));
        } catch (Exception $error) {
            return back()->with('error', $error->getMessage());
        }
    }
    public function academic_subject_lesson(Request $_request)
    {
        $_course_syllabus = new CourseSyllabus();
        $_subject_class = SubjectClass::find(base64_decode($_request->_subject));
        $_subject_code =  $_subject_class->curriculum_subject->subject->subject_code;
        $_subject_content = $_subject_code == 'ICT' ? $_course_syllabus->ict() : [];
        //return $_subject_content;
        //return $_subject_content[0]['learning_outcome'][0];
        $_subject_lesson = $_subject_content ? $_subject_content[0]['learning_outcome'][0] : [];
        return view('pages.student.academic.subject-lesson', compact('_subject_content', '_subject_class', '_subject_lesson'));
    }
    /* Enrollment */
    public function enrollment_view()
    {
        //return view('pages.student.enrollment.view');
        $_enrollment_assessment = Auth::user()->student->enrollment_assessment;
        $_account = StudentAccount::find(Auth::user()->id);
        if ($_enrollment_assessment->year_level == 12 && $_account->current_semester()->semester == 'First Semester') {
            $_parent_details = ParentDetails::where('student_id', Auth::user()->student_id)->where('is_removed', false)->first();
            return view('pages.student.enrollment.seniorhigh_overview');
        } else {
            return view('pages.student.enrollment.overview');
        }
    }
    public function enrollment_application(Request $_request)
    {
        try {
            $_up_comming_academic = AcademicYear::where('is_active', 1)->first();
            $_enrollment_application = EnrollmentApplication::where(['student_id' => Auth::user()->student_id, 'academic_id' => $_up_comming_academic->id])->where('is_removed', false)->first();
            if (!$_enrollment_application) {
                $_details = [
                    'student_id' => Auth::user()->student_id,
                    'academic_id' => $_up_comming_academic->id,
                    'course_id' => $_request->_course ?: Auth::user()->student->enrollment_assessment->course_id,
                    'enrollment_place' => 'online',
                    'is_removed' => false,
                ];

                EnrollmentApplication::create($_details);
                return redirect(route('enrollment'))->with('success', 'Successfully Send your Enrollment Application!');
            } else {
                return redirect(route('enrollment'))->with('error', 'Your Already Submit Enrollment Application!');
            }
        } catch (Exception $error) {

            return back()->with('error', $error->getMessage());
        }
    }
    public function payment_application(Request $_request)
    {
        try {
            //$_application = EnrollmentApplication::where('student_id', Auth::user()->student_id)->first();
            $_application = Auth::user()->student->enrollment_application;
            $_application->payment_mode = $_request->mode;
            $_application->save();
            return back()->with('success', 'Successfully Submitted.');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function payment_store(Request $_request)
    {
        try {
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
        } catch (Exception $error) {
            return back()->with('error', $error->getMessage());
        }
    }
    /* Enrollment end */

    public function view_student_profile(Request $_request)
    {
        return view('pages.student.home.student_profile_form');
    }
    public function enrollment_registration_form()
    {
        return view('pages.student.enrollment.components.registration_form');
    }
    public function enrollment_registration_store(Request $_request)
    {
        $_input_feilds = [
            '_first_name' => 'required',
            '_last_name' => 'required',
            '_middle_name' => 'required | min:3',
            '_extension_name' => 'required | min:2',
            '_birthday' => 'required',
            '_birth_place' => 'required',
            '_gender' => 'required',
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
        if (Auth::user()->course_id != 3) {
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
        try {
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
                'sex' => $_request->_gender,
                'is_removed' => false
            );
            $_elementary = array(
                'student_id',
                'school_level' => 'Elementary School',
                'school_name' => trim(ucwords(mb_strtolower($_request->elementary_school_name))),
                'school_address' => trim(ucwords(mb_strtolower($_request->elementary_school_address))),
                'graduated_year' =>  trim(ucwords(mb_strtolower($_request->elementary_school_year))),
                "school_category" => 'n/a',
                "is_removed" => false
            );
            $_high_school = array(
                'student_id',
                'school_level' => 'Junior High School',
                'school_name' => trim(ucwords(mb_strtolower($_request->junior_high_school_name))),
                'school_address' => trim(ucwords(mb_strtolower($_request->junior_high_school_address))),
                'graduated_year' =>  trim(ucwords(mb_strtolower($_request->junior_high_school_year))),
                "school_category" => 'n/a',
                "is_removed" => false
            );
            $_senior_high_school = array(
                'student_id',
                'school_level' => 'Senior High School',
                'school_name' => trim(ucwords(mb_strtolower($_request->senior_high_school_name))),
                'school_address' => trim(ucwords(mb_strtolower($_request->senior_high_school_address))),
                'graduated_year' =>  trim(ucwords(mb_strtolower($_request->senior_high_school_year))),
                "school_category" => 'n/a',
                "is_removed" => false
            );
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
            $_education =  [$_elementary, $_high_school, $_senior_high_school];
            $_student_checker = StudentDetails::where($_student_details)->first();
            if ($_student_checker) {
                $_educational = EducationalDetails::where('student_id', $_student_checker->id)->count();
                // Educational Background
                if ($_educational > 0) {
                    EducationalDetails::where('student_id', $_student_checker->id)->update(['is_removed', true]);
                    foreach ($_education as $key => $value) {
                        $value['student_id'] = $_student_checker->id;
                        EducationalDetails::create($value);
                    }
                }
                // Additional Details
                $_parent_details = ParentDetails::where('student_id', $_student_checker->id)->where('is_removed', false)->first();
                if ($_parent_details) {
                    $_parent_details->is_removed = true;
                    $_parent_details->save();
                    $_parent_info += ['student_id' => $_student_checker->id];
                    ParentDetails::create($_parent_info);
                } else {
                    $_parent_info += ['student_id' => $_student_checker->id];
                    ParentDetails::create($_parent_info);
                }
            } else {
                // Create Student Information 
                $_student_store = StudentDetails::create($_student_details);
                // Educational Background
                foreach ($_education as $key => $value) {
                    $value['student_id'] = $_student_store->id;
                    EducationalDetails::create($value);
                }
                // Additional Details
                $_parent_info += ['student_id' => $_student_store->id];
                ParentDetails::create($_parent_info);
            }

            return redirect(route('applicant.enrollment'))->with('success', 'Successfully Submit the Registrartion Form');
        } catch (Exception $error) {
            return back()->with('error', $error->getMessage());
        }
    }
    public function registration_form()
    {
        $_student_report = new StudentReport();
        $_student = Auth::user()->student;
        return $_student_report->student_registrartion_form($_student);
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
        return view('pages.student.grades.view');
    }
    public function payments_view(Request $_request)
    {
        $_student = Auth::user()->student;
        //$_course_semestral_fee = $_student->enrollment_assessment->payment_assessments->course_semestral_fee;
        $_payment_details = $_request->_payment_assessment  ? PaymentAssessment::find(base64_decode($_request->_payment_assessment)) : $_student->enrollment_assessment->payment_assessments;
        return view('pages.student.payments.view', compact('_payment_details', '_student'));
    }

    public function onboard_view(Request $_request)
    {
        $_certificates = TrainingCertificates::where('is_removed', 1)->orderByRaw('CHAR_LENGTH("training_name")')->get();
        $_documents = Documents::where('is_removed', 1)->where('document_propose', 'PRE-DEPLOYMENT')->orderByRaw('CHAR_LENGTH("document_name")')->get();
        $_assess = DeploymentAssesment::where('student_id', Auth::user()->student_id)->where('is_removed', 0)->first();
        $_document_requirement = DocumentRequirements::where('student_id', Auth::user()->student_id)->where('is_removed', 0)->get();
        $_agency = ShippingAgencies::where('is_removed', 1)->get();
        $_journal = ShipboardJournal::select('month', DB::raw('count(*) as total'))->where('student_id', Auth::user()->student_id)->where('is_removed', false)->groupBy('month')->get();
        return view('pages.student.onboard.view', compact('_certificates', '_documents', '_agency', '_assess', '_document_requirement', '_journal'));
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
        return view('pages.student.onboard.journal_create');
    }
    public function store_journal(Request $_request)
    {
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
        //
    }
    public function reupload_journal_file(Request $_request)
    {
        $_request->validate([
            'file_links' => 'required',
        ]);
        try {
            // Get all the Data
            $_data = array(
                'student_id' => Auth::user()->student_id,
                'month' => $_request->_month,
                'journal_type' => $_request->_name,
                'is_removed' => 0
            );
            $_journal = ShipboardJournal::where($_data)->first(); // Check the Journal Category
            if ($_journal) {
                // If true removed the exsiting data and Save
                $_journal->is_removed = 1;
                $_journal->save();
                // Add the Following Index 
                $_data['file_links'] = $_request->file_links;
                $_data['remark'] = $_request->_remarks;
                // Store the new Journal Category
                ShipboardJournal::create($_data);
                return back()->with('success', 'Successfully Re-Upload Files');
            }
        } catch (Exception $error) {
            return back()->with('error', $error->getMessage());
        }
    }
    public function view_journal(Request $_request)
    {
        try {
            $_journal = ShipboardJournal::where([
                'student_id' => Auth::user()->student->id,
                'month' => base64_decode($_request->_j),
                'is_removed' => false
            ])->get();
            $_journals = ShipboardJournal::select('month', DB::raw('count(*) as total'))->where('student_id', Auth::user()->student_id)->groupBy('month')->get();
            return view('pages.student.onboard.journal_view', compact('_journal', '_journals'));
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
    public function upload_journal_file(Request $_request)
    {
        try {
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
            //FTP Back up file
            $_file_path = 'public/students/' . $_user . '/onboard'; // Public Path
            Storage::disk('ftp')->put($_file_path . '/' . $_file_name, fopen($_request->file('file'), 'r+')); // Back-up Upload
            $_file_links = $_url_link . $_file_name; // Get the Link of the Files
            //Upload File to external server
            return  $_file_links;
        } catch (Exception $error) {
            return $error->getMessage();
        }
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
    # ONBOARD EXAMINATION
    public function onboard_examination(Request $_request)
    {
        $_request->validate([
            'exam_code' => 'required',
        ]);
        try {
            $_examination = Auth::user()->student->onboard_assessment;
            if ($_request->exam_code == $_examination->examination_code) {
               // $_examination->examination_start = now();
               // $_examination->is_finish = 0;
               // $_examination->save();
               return route('onboard.examination-view') . '/' . base64_encode($_examination->id);
                return redirect(route('onboard.examination-view') . '/' . base64_encode($_examination->id))->with('success', 'Examination Code Verified');
            } else {
                return back()->with('error', 'Invalid Examination Code, Try again!');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function onboard_examination_view($_examination)
    {
        $_examination = ShipboardExamination::find(base64_decode($_examination));
        return $_examinations = $_examination->assessment_question;
        return view('pages.student.onboard.examination_questioner', compact('_examinations'));
    }
    public function account_view()
    {
        return view('pages.student.home.account_view');
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
    public function attendance_form_view()
    {
        return view('pages.student.qr-code.view');
    }
    public function attendance_store(Request $_request)
    {
        $_request->validate([
            'employee' => 'required ',
            'body_temp' => 'required',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required'
        ]);
        $_staff_details = array(
            $_request->employee,
            json_encode(array(
                $_request->body_temp,
                $_request->question1,
                $_request->question2,
                $_request->question3,
            )),
            date('Y-m-d H:i:s'),
        );
        $_data = json_encode($_staff_details);
        $_data = base64_encode($_data);
        return view('pages.student.qr-code.generate', compact('_data'));
        //return back()/* redirect() */->with('qr-code', $_data);
    }
}
