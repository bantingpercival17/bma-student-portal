<?php

namespace App\Http\Controllers;

use App\Models\ApplicantDetials;
use App\Models\ApplicantDocuments;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function index()
    {
        return view('pages.applicant.home.dashboard');
    }
    public function applicant_view()
    {
        return view('pages.applicant.home.view');
    }
    public function create_applicant_details(Request $_request)
    {
        $_inputs = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'extension_name' => 'required|string',
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
            /* 'father_name' => 'required',
            'father_contact_number' => 'required',
            'mother_name' => 'required',
            'mother_contact_number' => 'required',
            'parent_address' => 'required', */
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
        foreach ($_inputs as $key => $value) {
            //$_data[$value] = trim(ucwords(strtolower($_request->input('_first_name')))) ;
            $_data[$key] = ucwords(mb_strtolower(trim($value)));
        }
        $_data += ['applicant_id' => Auth::user()->id];
        ApplicantDetials::create($_data);
        return redirect(route('applicant.home'))->with('success', 'Successfully Add Applicant Information');
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
}
