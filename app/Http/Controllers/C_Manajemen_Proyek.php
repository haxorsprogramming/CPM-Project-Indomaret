<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Manajemen_Proyek extends Controller
{
    public function data_proyek()
    {
        return view('dashboard.manajemen_proyek_page');
    }
}
