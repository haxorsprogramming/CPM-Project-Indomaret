<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_Proyek;

class C_Manajemen_Proyek extends Controller
{
    public function data_proyek()
    {
        $data_proyek = M_Proyek::all();
        $dr = ['data_proyek' => $data_proyek];
        return view('dashboard.manajemen_proyek_page', $dr);
    }

    public function proses_tambah(Request $request)
    {
        // {'kd_proyek':kd_proyek, 'nama_proyek':nama_proyek, 'deksripsi':deksripsi}
        $kd_proyek = $request -> kd_proyek;
        $nama_proyek = $request -> nama_proyek;
        $deksripsi = $request -> deksripsi;

        $proyek = new M_Proyek();

        $proyek -> kd_proyek = $kd_proyek;
        $proyek -> nama_proyek = $nama_proyek;
        $proyek -> deksripsi = $deksripsi;
        $proyek -> aktif = 'y';
        $proyek -> save();

        $dr = ['status' => 'sukses'];
        return \Response::json($dr);
    }
}
