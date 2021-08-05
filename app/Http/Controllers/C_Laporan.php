<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_Proyek;
use App\Models\M_Hasil;

class C_Laporan extends Controller
{
    public function laporan_proyek()
    {
        $data_proyek = M_Proyek::all();
        $dr = ['data_proyek' => $data_proyek];
        return view('dashboard.laporan_pilih_proyek', $dr);
    }

    public function detail_laporan($kd_proyek)
    {
        $data_hasil = M_Hasil::all();
        $dr = ['data_hasil' => $data_hasil];
        return view('dashboard.detail_laporan', $dr);
    }

}
