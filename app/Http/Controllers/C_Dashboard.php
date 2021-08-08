<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_User;
use App\Models\M_Proyek;
use App\Models\M_Kegiatan;


class C_Dashboard extends Controller
{
    public function dashboard_page(Request $request)
    {
        $data_session = $request->session()->get('user_login');
        // if ($request->session()->exists('user_login')) {
            
        // }else{
        //     
        // }

        if (isset($data_session)) {
            $username_session = session('user_login');
            // cari tipe user 
            $data_user = M_User::where('username', $username_session) -> first();
            $tipe_user = $data_user['tipe_user'];
            $dr = ['tipe_user' => $tipe_user];
            return view('dashboard.dashboard_page', $dr);

          }else{
            return view('login.login_page');
          }
       
    }

    public function beranda_page()
    {
        $total_proyek = M_Proyek::count();
        $total_kegiatan = M_Kegiatan::count();
        $total_user = M_User::count();
        $dr = ['total_proyek' => $total_proyek, 'total_kegiatan' => $total_kegiatan, 'total_user' => $total_user];
        return view('dashboard.beranda_page', $dr);
    }
}
