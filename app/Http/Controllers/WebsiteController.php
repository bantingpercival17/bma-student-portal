<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TicketMail;
use App\Models\AcademicYear;
use App\Models\ApplicantAccount;
use App\Models\Ticket;
use App\Models\TicketChat;
use App\Models\TicketConcern;
use App\Models\TicketIssue;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

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
        $_number = TicketConcern::all();
        //$_name = str_ireplace(array('a', 'e', 'o', 'i', 'u'), '', $_request->full_name);
        //$_add_number = $this->alphabet_to_number($_name);
        $_ticket_number =  date('ymd-hs') . $_number->count();
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
        $_ticket_mail = new TicketMail($_ticket);
        Mail::to($_request->email)->send($_ticket_mail);
        return redirect(route('ticket-view') . '?_t=' . base64_encode($_ticket_number))->with('success', 'Thank you, your concern will be sent. TICKET NUMBER: ' . $_ticket_number);
    }

    function alphabet_to_number($string)
    {
        $value = strtolower($string);
        $alphabet =   array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        $returnValue = '';
        for ($index = 0; $index < strlen($value); $index++) {
            $number = 1;
            foreach ($alphabet as $key => $alpha) {
                if ($alpha == $value[$index]) {
                    $returnValue .= strval($number);
                }
                $number += 1;
            }
        }
        return $returnValue;
        /*  $string = strtoupper($string);
        $length = strlen($string);
        $number = 0;
        $level = 1;
        while ($length >= $level) {
            $char = $string[$length - $level];
            $c = ord($char) - 64;
            $number += $c * (26 ** ($level - 1));
            $level++;
        }
        return $number; */
    }
    public function ticket_login(Request $_request)
    {
        $_request->validate([
            'ticket' => 'required'
        ]);
        $ticket = Ticket::where(['ticket_number' => $_request->ticket, 'is_removed' => 0])->first();
        if ($ticket) {
            return redirect(route('ticket-view') . '?_t=' . base64_encode($ticket->ticket_number));
        } else {
            return back()->with('error', 'Invalid Ticket Number');
        }
    }
    public function ticket_view(Request $_request)
    {
        $ticket = Ticket::where(['ticket_number' => base64_decode($_request->_t), 'is_removed' => 0])->first();
        TicketChat::where('ticket_id', $ticket->concern->id)->where('sender_column', 'ticket_id')->where('is_removed', false)->update(['is_read' => true]);
        $messages = TicketChat::where('ticket_id', $ticket->concern->id)->where('is_removed', false)->get();
        return view('pages.website.contact-us.ticket_view', compact('ticket',  'messages'));
    }
    public function ticket_message_chat(Request $_request)
    {
        //(Auth::id() > $_request->user) ? Auth::id() . $_request->user : $_request->user . Auth::id();
        $_data = array(
            'ticket_id' => $_request->ticket,
            'staff_id' => $_request->staff,
            'sender_column' => 'ticket_id',
            'message' => $_request->message,
            'group_id' => ($_request->staff > $_request->ticket) ? $_request->staff . $_request->ticket : $_request->ticket . $_request->staff,
        );
        try {
            TicketChat::create($_data);
            $data = array(
                'respond' => 200,
                'data' => $_data
            );
        } catch (\Exception $error) {
            $data = array(
                'respond' => 404,
                'message' => $error->getMessage()
            );
        }

        return compact('data');
    }
    public function upload_document_file(Request $_request)
    {
        $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        $_user = base64_decode($_request->_ticket_number);
        $_url_link =  $link . '/storage/ticket/concern-image/' . $_user . '/';
        $_file_path = '/public/ticket/concern-image/' . $_user . '/';
        $file = $_request->file('file');
        $_date = date('dmYhms');
        $_file_name =  $_user .  $_request->_documents . '_' . $_request->_file_number . $_date . "." . $file->getClientOriginalExtension(); // Set a File name with Username and the Original File name
        $file->storeAs($_file_path, $_file_name); // Store the File to the Folder
        $_file_links = $_url_link . $_file_name; // Get the Link of the Files
        return  $_file_links;
    }
}
