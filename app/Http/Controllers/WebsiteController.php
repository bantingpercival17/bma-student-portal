<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\ApplicantAccount;
use App\Models\Ticket;
use App\Models\TicketConcern;
use App\Models\TicketIssue;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('pages.website.home.view');
    }

    public function admission_view(Request $_request)
    {
        return view('pages.website.admission.view');
    }

    public function admission_store(Request $_request)
    {
        $_fields = $_request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|unique:mysql2.applicant_accounts,email',
            //'password' => 'required|string|confirmed',
            'contact_number' => 'required',
            'password' => 'required|string',
            '_course' => 'required'
        ]);
        $_academic = AcademicYear::where('is_active', 1)->first();
        $_details =  [
            'name' => $_request->first_name . ' ' . $_request->last_name,
            'email' => $_request->email,
            'course_id' => $_request->_course,
            'contact_number' => $_request->contact_number,
            'password' => Hash::make($_request->password),
            'applicant_number' => 'TR-' . date('ymd') . (ApplicantAccount::all()->count() + 1),
            'academic_id' => $_academic->id,
            'is_removed' => 0
        ];
        //return $_details;
        $user = ApplicantAccount::create($_details);
        //event(new Registered($user));
        Auth::guard('applicant')->login($user);

        return redirect('/bma/applicant')->with('success', 'Successfully Register');
    }
    public function login_view(Request $_request)
    {
        return view('pages.applicant.auth.login');
    }
    public function login(Request $_request)
    {
        $_fields = $_request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);  # code...
        $_applicant = ApplicantAccount::where('email', $_fields['email'])->first();
        if (!$_applicant || Hash::make($_fields['password']) == $_applicant->password) {
            return response([
                'message' => 'Invalid Creds',
            ], 401);
        } else {
            // event(new Registered($_applicant));
            Auth::guard('applicant')->login($_applicant);
            return redirect('bma/applicant');
        }
    }
    public function contact_us_view()
    {
        $_concern = TicketIssue::where('is_removed', 0)->get();
        return view('pages.website.contact-us.view', compact('_concern'));
    }
    public function contact_us_store(Request $_request)
    {
        $_request->validate([
            'full_name' => 'required',
            'email' => 'required|unique:mysql2.tickets|email',
            'address' => 'required',
            'contact_number' => 'required',
            'concern' => 'required',
            'concern_message' => 'required'
        ]);
        // TNYM-0001
        //TN042022-RLNDRTHRMGLNZ
        $_name = str_ireplace(array('a', 'e', 'o', 'i', 'u'), '', $_request->full_name);
        $_ticket_number = 'TN' . date('mY') . '-' . strtoupper(str_replace(' ', '', strtolower($_name)));
        $_ticket = Ticket::create([
            'name' => $_request->full_name,
            'email' => $_request->email,
            'contact_number' => $_request->contact_number,
            'address' => $_request->address,
            'ticket_number' => $_ticket_number
        ]);
        TicketConcern::create([
            'ticket_id' => $_ticket->id,
            'issue_id' => $_request->concern,
            'ticket_message' => $_request->concern_message
        ]);
        return back()->with('success', 'Thank you, your concern will be sent. TICKET NUMBER: ' . $_ticket_number);
    }
}
