<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\M_User;

class C_User extends Controller
{
    public function data_user()
    {
        $data_user = M_User::all();
        $dr = ['data_user' => $data_user];
        return view('dashboard.manajemen_user_page', $dr);
    }

    public function proses_tambah(Request $request)
    {
        // {'username':username, 'password':password, 'tipe':tipe}
        $username = $request -> username;
        $password = md5($request -> password);
        $tipe = $request -> tipe;
        $now = Carbon::now();
        
        $user = new M_User();
        $user -> username = $username;
        $user -> kata_sandi = $password;
        $user -> tipe_user = $tipe;
        $user -> last_login = $now;
        $user -> aktif = 'y';
        $user -> save();

        $dr = ['status' => 'sukses'];
        return \Response::json($dr);
    }
}
