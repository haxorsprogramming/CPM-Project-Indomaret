<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Page extends Controller
{
    public function login_page()
    {
        return view('login.login_page');
    }
}
