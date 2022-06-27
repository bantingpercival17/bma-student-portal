<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ApplicantAccount;
use App\Models\ApplicantBriefing;
use App\Models\ApplicantDetials;
use App\Models\ApplicantDocuments;
use App\Models\ApplicantEntranceExamination;
use App\Models\ApplicantExaminationAnswer;
use App\Models\ApplicantMedicalAppointment;
use App\Models\ApplicantPayment;
use App\Models\Documents;
use App\Models\EducationalDetails;
use App\Models\EnrollmentApplication;
use App\Models\Examination;
use App\Models\ParentDetails;
use App\Models\PaymentTrasanctionOnline;
use App\Models\StudentDetails;
use App\Report\Students\StudentReport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function index()
    {
        $_level = Auth::user()->course_id == 3 ? 11 : 4;
        $_documents = Documents::where('year_level', $_level)->where('department_id', 2)->where('is_removed', false)->get();
        return view('pages.applicant.home.overview', compact('_documents'));
    }
    public function applicant_view()
    {
        return view('pages.applicant.home.view');
    }
    public function applicant_update_view()
    {
        $_applicant = Auth::user()->applicant;
        return view('pages.applicant.home.update-information', compact('_applicant'));
    }
    public function create_applicant_details(Request $_request)
    {
        try {
            $_inputs = [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'middle_name' => 'required|string',
                'extention_name' => 'required|string',
                'sex' => 'required|string',
                'birthday' => 'required|date',
                'birth_place' => 'required|string',
                'street' => 'required|string',
                'barangay' => 'required|string',
                'municipality' => 'required|string',
                'province' => 'required|string',
                'zip_code' => 'required',
                'civil_status' => 'required',
                'nationality' => 'required',
                'religion' => 'required',
                'elementary_school_name' => 'required|max:100',
                'elementary_school_address' => 'required|max:255',
                'elementary_school_year' => 'required|max:100',
                'junior_high_school_name' => 'required|max:100',
                'junior_high_school_address' => 'required|max:255',
                'junior_high_school_year' => 'required|max:100',
            ];
            if (Auth::user()->course_id != 3) {
                $_inputs += [
                    'senior_high_school_name' => 'required|max:100',
                    'senior_high_school_address' => 'required|max:255',
                    'senior_high_school_year' => 'required|max:100',
                ];
            }
            $_inputs += [  // FATHER INFORMATION
                'father_last_name' => 'required | min:2 | max:50',
                'father_first_name' => 'required | min:2 | max:50',
                'father_middle_name' => 'required | min:2 | max:50',
                'father_educational_attainment' => 'required | min:2 | max:100',
                'father_employment_status' => 'required | min:2 | max:50',
                'father_working_arrangement' => 'required | min:2 | max:50',
                'father_contact_number' => 'required| min:2 | max:12',
                // MOTHER INFORMATION
                'mother_last_name' => 'required | min:2 | max:50',
                'mother_first_name' => 'required | min:2 | max:50',
                'mother_middle_name' => 'required | min:2 | max:50',
                'mother_educational_attainment' => 'required | min:2 | max:100',
                'mother_employment_status' => 'required | min:2 | max:50',
                'mother_working_arrangement' => 'required | min:2 | max:50',
                'mother_contact_number' => 'required | min:2 | max:12',
                // GUARDIAN  INFORMATION
                'guardian_last_name' => 'required | min:2 | max:50',
                'guardian_first_name' => 'required | min:2 | max:50',
                'guardian_middle_name' => 'required | min:2 | max:50',
                'guardian_educational_attainment' => 'required | min:2 | max:50',
                'guardian_employment_status' => 'required | min:2 | max:50',
                'guardian_working_arrangement' => 'required | min:2 | max:50',
                'guardian_contact_number' => 'required| min:2 | max:12',
            ];
            $_inputs = $_request->validate($_inputs);
            $_data = [];
            //return $_inputs['junior_high_school_year'];
            foreach ($_inputs as $key => $value) {
                //$_data[$value] = trim(ucwords(strtolower($_request->input('_first_name')))) ;
                $_data[$key] = ucwords(mb_strtolower(trim($value)));
            }
            $_data += ['applicant_id' => Auth::user()->id];
            $_data['elementary_school_year'] = $_inputs['elementary_school_year'] . '-01';
            $_data['junior_high_school_year'] = $_inputs['junior_high_school_year'] . '-01';
            if (Auth::user()->course_id != 3) {
                $_data['senior_high_school_year'] = $_inputs['senior_high_school_year'] . '-01';
            }
            if (Auth::user()->applicant) {
                Auth::user()->applicant->update($_data);
                /*  Auth::user()->applicant->update(['elementary_school_year' => $_inputs['elementary_school_year'] . '-01']);
                Auth::user()->applicant->update(['junior_high_school_year' => $_inputs['junior_high_school_year'] . '-01']);
                if (Auth::user()->course_id != 3) {
                    Auth::user()->applicant->update(['senior_high_school_year' => $_inputs['senior_high_school_year'] . '-01']);
                } */
                return redirect(route('applicant.home'))->with('success', 'Successfully Update Applicant Information');
            } else {
                ApplicantDetials::create($_data);
                return redirect(route('applicant.home'))->with('success', 'Successfully Add Applicant Information');
            }
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }
    public function applicant_form_pdf()
    {
        $_student_report = new StudentReport();;
        $_student = Auth::user();
        return $_student_report->applicant_form($_student);
    }
    public function document_view(Request $_request)
    {
        $_level = Auth::user()->course_id == 3 ? 11 : 4;
        $_documents = Documents::where('year_level', $_level)->where('department_id', 2)->where('is_removed', false)->get();
        return view('pages.applicant.home.document_view', compact('_documents'));
    }
    public function store_documents(Request $_request)
    {
        foreach ($_request->file_url as $key => $value) {
            $_data = array(
                'applicant_id' => Auth::user()->id,
                'document_id' => (int) $_request->document[$key],
                'file_links' => $value,
                'is_removed' => 0
            );
            ApplicantDocuments::create($_data);
        }
        return redirect(route('applicant.home'))->with('success', 'Successfully Upload the Document Requirement');
        return dd($_data);
    }
    public function reupload_documents(Request $_request)
    {
        $_data = array(
            'applicant_id' => Auth::user()->id,
            'document_id' => (int) $_request->document,
            'file_links' => $_request->file_link,
            'is_removed' => 0
        );
        if ($_request->applicant_doc) {
            $_documents = ApplicantDocuments::find($_request->applicant_doc);
            $_documents->is_removed = 1;
            $_documents->save();
        }
        ApplicantDocuments::create($_data);
        return redirect(route('applicant.home'))->with('success', 'Successfully Upload the Document Requirement');
    }

    public function upload_document_file(Request $_request)
    {
        $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        $_user = str_replace(' ', '_', strtolower(trim(Auth::user()->name)));
        $_url_link =  $link . '/storage/registrar/applicant-documents/' . $_user . '/';
        $_file_path = '/public/registrar/applicant-documents/' . $_user . '/';
        $file = $_request->file('file');
        $_date = date('dmYhms');
        $_file_name = '[' . $_user . ']' . $_request->_documents . '_' . $_request->_file_number . $_date . "." . $file->getClientOriginalExtension(); // Set a File name with Username and the Original File name
        $file->storeAs($_file_path, $_file_name); // Store the File to the Folder
        $_file_links = $_url_link . $_file_name; // Get the Link of the Files
        return  $_file_links;
    }
    public function logout(Request $request)
    {
        Auth::guard('applicant')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/bma/login');
    }


    public function payment_store(Request $_request)
    {
        $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        $_file_path = '/public/accounting/applicant/proof_of_payments/';
        $_request->validate([
            '_transaction_date' => 'required',
            '_amount_paid' => 'required',
            '_reference_number' => 'required',
            '_transaction_type' => 'required',
            '_file' => 'required'
        ]);
        $_ext = $_request->_file->getClientOriginalExtension();
        $_user = str_replace(' ', '_', Auth::user()->name);
        $_url_link =  $link . '/storage/accounting/applicant/proof_of_payments/';
        $_file_name =   strtolower($_user . "-" . 'proof-of-payment' . str_replace('_', '-', $_request->_transaction_type)) . "." . $_ext;
        $_request->_file->storeAs($_file_path, $_file_name);
        $_payment_data = array(
            'applicant_id' => Auth::user()->id,
            'amount_paid' => str_replace(',', '', $_request->_amount_paid),
            'reference_number' => $_request->_reference_number,
            'transaction_type' => $_request->_transaction_type,
            'reciept_attach_path' => $_url_link . $_file_name,
            'is_removed' => 0
        );
        if (Auth::user()->payment) {
            Auth::user()->payment->update(['is_removed' => true]);
        }
        ApplicantPayment::create($_payment_data);
        return back()->with('success', 'Successfully Submitted.');
    }
    public function examination_verification(Request $_request)
    {
        $_request->validate([
            'exam_code' => 'required',
        ]);
        $_examination = Auth::user()->examination;
        if ($_examination) {
            if ($_examination->examination_code == $_request->exam_code) {
                if ($_examination->is_finish == null) {
                    $_examination->is_finish = 0; // I mean Ongoing the Examination, the null mean they have an examination/test questioner we to verified
                    $_examination->created_at = now();
                    $_examination->save();
                    return redirect(route('applicant.entrance-examination'))->with('success', 'Entrance Examination Code Verified');
                } else {
                    return back()->with('error', 'This Already take the Entrance Examination!');
                }
            } else {
                return back()->with('error', 'Invalid Examination Code, Try again!');
            }
        }
    }
    public function examination_view(Request $_request)
    {

        $_department = Auth::user()->course->id == 3 ? 'SENIOR HIGHSCHOOL' : 'COLLEGE';
        $_examination =  Examination::where('department', $_department)->where('examination_name', 'ENTRANCE EXAMINATION')->where('is_removed', false)->first();
        return view('pages.applicant.home.examination_questioner', compact('_examination'));
    }
    public function examination_store(Request $_request)
    {
        $_department = Auth::user()->course->id == 3 ? 'SENIOR HIGHSCHOOL' : 'COLLEGE';
        $_examination =  Examination::where('department', $_department)->where('examination_name', 'ENTRANCE EXAMINATION')->first();
        /*  $fields = [];
        foreach ($_examination->categories as $key => $category) {
            foreach ($category->questions as $key_category => $question) {
                $fields += [base64_encode($question->id) => 'required'];
            }
        } */
        //$_request->validate($fields);
        $_data = [];
        //return Auth::user()->examination->id;
        //return $_request->question;
        foreach ($_request->question as $key => $value) {
            $_data = array(
                'question_id' => $value,
                'choices_id' => $_request->input(base64_encode($value)),
                'examination_id' => Auth::user()->examination->id,
            );
            $_answer = ApplicantExaminationAnswer::where([
                'question_id' => $value,
                'examination_id' => Auth::user()->examination->id,
            ])->first();
            if (!$_answer) {
                ApplicantExaminationAnswer::create($_data);
            }
        }

        $_examinee = ApplicantEntranceExamination::where('applicant_id', Auth::id())->where('is_removed', 0)->first();
        $_examinee->is_finish = true;
        $_examinee->save();
        return redirect(route('applicant.home'))->with('success', 'Examination Finish');
    }

    public function virtual_orientation(Request $_request)
    {
        return view('pages.applicant.home.virtual-briefing');
    }
    public function virtual_orientation_complete(Request $_request)
    {
        try {
            $_data = array(
                'applicant_id' => $_request->_applicant,
                'is_completed' => 1
            );
            $_data_exist = ApplicantBriefing::where($_data)->where('is_removed', false)->first();
            if ($_data_exist) {
                $_data_exist->is_removed = 1;
                $_data_exist->save();
                ApplicantBriefing::create($_data);
            } else {
                ApplicantBriefing::create($_data);
            }

            $data = array('respond' => 200, 'message' => 'Done');
            return compact('data');
        } catch (\Throwable $th) {
            $data = array('respond' => 404, 'message' => $th);
            return compact('data');
        }
    }
    public function medical_schedule(Request $_request)
    {
        try {
            $_value = array(
                'applicant_id' => Auth::user()->id,
                'appointment_date' => "2022-06-" . $_request->_date,
                'approved_by' => 7
            );
            ApplicantMedicalAppointment::create($_value);
            return back()->with('success', 'Appointment Schedule Success.');
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }
    public function enrollment_overview(Request $_request)
    {
        return view('pages.applicant.enrollment.overview');
    }
    public function enrollment_form_view()
    {
        return view('pages.applicant.enrollment.components.registrartion_form');
    }
    public function enrollment_form_store(Request $_request)
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
            $_education = Auth::user()->course_id == 3 ? [$_elementary, $_high_school] : [$_elementary, $_high_school, $_senior_high_school];
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
    public function enrollmet_registrartion_form()
    {
        $_student_report = new StudentReport();
        $_student = StudentDetails::where('first_name', Auth::user()->applicant->first_name)
            ->where('last_name', Auth::user()->applicant->last_name)
            ->where('middle_name', Auth::user()->applicant->middle_name)
            ->where('birthday', Auth::user()->applicant->birthday)
            ->where('is_removed', false)
            ->first();
        return $_student_report->registrartion_form($_student);
    }
    public function enrollment_assessment(Request $_request)
    {
        try {
            $_up_comming_academic = AcademicYear::where('is_active', 1)->first();
            $_student = ApplicantAccount::find(Auth::user()->id);
            $_student = $_student->enrollment_registration();
            $_enrollment_application = EnrollmentApplication::where(['student_id' => $_student->id, 'academic_id' => $_up_comming_academic->id, 'course_id' => $_request->_course])->where('is_removed', false)->first();
            if (!$_enrollment_application) {
                $_details = [
                    'student_id' => $_student->id,
                    'academic_id' => $_up_comming_academic->id,
                    'course_id' => $_request->_course,
                    'enrollment_place' => 'online',
                    'strand' => $_request->_strand,
                    'is_removed' => false,
                ];
                //return $_details;
                EnrollmentApplication::create($_details);
                return redirect(route('applicant.enrollment'))->with('success', 'Successfully Send your Enrollment Application!');
            } else {
                return redirect(route('applicant.enrollment'))->with('error', 'Your Already Submit Enrollment Application!');
            }
        } catch (Exception $error) {

            return back()->with('error', $error->getMessage());
        }
    }
    public function enrollment_payment_mode(Request $_request)
    {
        try {
            $_user = ApplicantAccount::find(Auth::user()->id);
            $_application = $_user->enrollment_registration()->enrollment_application;
            $_application->payment_mode = $_request->mode;
            $_application->save();
            return back()->with('success', 'Successfully Submitted.');
        } catch (Exception $error) {
            return back()->with('error', $error->getMessage());
        }
    }
    public function enrollment_payment_transaction(Request $_request)
    {
        try {
            $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $link .= "://";
            $link .= $_SERVER['HTTP_HOST'];
            $_file_path = '/public/accounting/applicant/proof_of_payments/';
            $_request->validate([
                '_transaction_date' => 'required',
                '_amount_paid' => 'required',
                '_reference_number' => 'required',
                '_transaction_type' => 'required',
                '_file' => 'required'
            ]);
            $_ext = $_request->_file->getClientOriginalExtension();
            $_user = str_replace(' ', '_', Auth::user()->name);
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
    public function enrollment_certificate(Request $_request)
    {
        try {
            $_student_report = new StudentReport();;
            $_student = ApplicantAccount::find(Auth::user()->id);
            $_student = $_student->enrollment_registration()->enrollment_assessment;
            return $_student_report->enrollment_information($_student->id);
        } catch (Exception $error) {
            return back()->with('error', $error->getMessage());
        }
    }
}
