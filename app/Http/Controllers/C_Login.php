<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Login extends Controller
{
    public function proses_login(Request $request)
    {
        $dr = ['status' => 'sukses'];
        return \Response::json($dr);
    }
}
