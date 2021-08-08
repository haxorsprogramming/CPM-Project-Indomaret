<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function proses_hapus(Request $request)
    {
        $kd_proyek = $request -> kd_proyek;
        DB::table('tbl_proyek') -> where('kd_proyek', $kd_proyek) -> delete();
        DB::table('tbl_kegiatan') -> where('kd_proyek', $kd_proyek) -> delete();
        $dr = ['status' => $kd_proyek];
        return \Response::json($dr);
    }

    public function edit_proyek($kd_proyek)
    {
        $data_proyek = DB::table('tbl_proyek') -> where('kd_proyek', $kd_proyek) -> first();
        $dr = ['data_proyek' => $data_proyek];
        return view('dashboard.edit_proyek_page', $dr);
    }

    public function edit_proses(Request $request)
    {
        $kd_proyek = $request -> kd_proyek;
        $nama_proyek = $request -> nama_proyek;
        $deksripsi = $request -> deksripsi;
        DB::table('tbl_proyek') -> where('kd_proyek', $kd_proyek) -> update(['nama_proyek' => $nama_proyek, 'deksripsi' => $deksripsi]);
        $dr = ['status' => 'sukses'];
        return \Response::json($dr);
    }


}
