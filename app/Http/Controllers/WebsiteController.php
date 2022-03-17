<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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




    public function contact_us_view()
    {
        return view('pages.website.contact-us.view');
    }
}
