<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Dashboard extends Controller
{
    public function dashboard_page()
    {
        return view('dashboard.dashboard_page');
    }

    public function beranda_page()
    {
        return view('dashboard.beranda_page');
    }
}
