<?php

namespace App\Http\Controllers\Auth_v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Login extends Controller
{
   public function create()
   {
       return view('auth.login');
   }

   public function store(Request $_request)
   {
       # code...
   }
}
