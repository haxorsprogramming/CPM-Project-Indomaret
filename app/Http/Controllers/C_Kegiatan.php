<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_Kegiatan;
use App\Models\M_Proyek;

class C_Kegiatan extends Controller
{
    public function data_kegiatan()
    {
        $data_proyek = M_Proyek::all();
        $data_kegiatan = M_Kegiatan::all();
        // dd($data_kegiatan);
        $dr = ['data_proyek' => $data_proyek, 'data_kegiatan' => $data_kegiatan];
        return view('dashboard.kegiatan_page', $dr);
    }

    public function proses_tambah(Request $request)
    {
        // {'kd_kegiatan':kd_kegiatan, 'nama_kegiatan':nama_kegiatan, 'deksripsi':deksripsi, 'kd_proyek':kd_proyek}
        $kd_kegiatan = $request -> kd_kegiatan;
        $nama_kegiatan = $request -> nama_kegiatan;
        $deksripsi = $request -> deksripsi;
        $kd_proyek = $request -> kd_proyek;

        $kegiatan = new M_Kegiatan();
        $kegiatan -> kd_kegiatan = $kd_kegiatan;
        $kegiatan -> kd_proyek = $kd_proyek;
        $kegiatan -> nama_kegiatan = $nama_kegiatan;
        $kegiatan -> deksripsi = $deksripsi;
        $kegiatan -> aktif = 'y';
        $kegiatan -> save();

        $dr = ['status' => 'sukses'];
        return \Response::json($dr);
    }
}
