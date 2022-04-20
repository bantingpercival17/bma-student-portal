<?php

namespace App\Http\Controllers;

use App\Models\ApplicantDetials;
use App\Models\ApplicantDocuments;
use App\Models\ApplicantEntranceExamination;
use App\Models\ApplicantExaminationAnswer;
use App\Models\ApplicantPayment;
use App\Models\Documents;
use App\Models\Examination;
use App\Report\Students\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function index()
    {
        $_level = Auth::user()->course_id == 3 ? 11 : 4;
        $_documents = Documents::where('year_level', $_level)->where('department_id', 2)->where('is_removed', false)->get();
        return view('pages.applicant.home.dashboard', compact('_documents'));
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
        if (Auth::user()->applicant) {
            Auth::user()->applicant->update($_data);
            Auth::user()->applicant->update(['elementary_school_year' => $_inputs['elementary_school_year'] . '-01']);
            Auth::user()->applicant->update(['junior_high_school_year' => $_inputs['junior_high_school_year'] . '-01']);
            if (Auth::user()->course_id != 3) {
                Auth::user()->applicant->update(['senior_high_school_year' => $_inputs['senior_high_school_year'] . '-01']);
            }
            return redirect(route('applicant.home'))->with('success', 'Successfully Update Applicant Information');
        } else {
            $_user = ApplicantDetials::create($_data);
            $_user->applicant->update(['elementary_school_year' => $_inputs['elementary_school_year'] . '-01']);
            $_user->applicant->update(['junior_high_school_year' => $_inputs['junior_high_school_year'] . '-01']);
            if ($_user->course_id != 3) {
                $_user->applicant->update(['senior_high_school_year' => $_inputs['senior_high_school_year'] . '-01']);
            }
            return redirect(route('applicant.home'))->with('success', 'Successfully Add Applicant Information');
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
        $_documents = ApplicantDocuments::find($_request->applicant_doc);
        $_documents->is_removed = 1;
        $_documents->save();
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
                if ($_examination->is_finish != 0) {
                    $_examination->is_finish = 0; // I mean Ongoing the Examination, the null mean they have an examination/test questioner we to verified
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
        $fields = [];
        foreach ($_examination->categories as $key => $category) {
            foreach ($category->questions as $key_category => $question) {
                $fields += [base64_encode($question->id) => 'required'];
            }
        }
        $_request->validate($fields);
        $_data = [];
        //return Auth::user()->examination->id;
        foreach ($_request->input() as $key => $inputs) {
            if ($key != "_token") {
                $_data = array(
                    'question_id' => base64_decode($key),
                    'choices_id' => $inputs,
                    'examination_id' => Auth::user()->examination->id,
                );
                $_answer = ApplicantExaminationAnswer::where([
                    'question_id' => base64_decode($key),
                    'examination_id' => Auth::user()->examination->id,
                ])->first();
                if (!$_answer) {
                    ApplicantExaminationAnswer::create($_data);
                }
            }
        }
        $_examinee = ApplicantEntranceExamination::where('applicant_id', Auth::id())->where('is_removed', 0)->first();
        $_examinee->is_finish = true;
        $_examinee->save();
        return redirect(route('applicant.home'))->with('success', 'Examination Finish');
    }
}
