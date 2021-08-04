<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\M_Proyek;
use App\Models\M_Kegiatan;
use App\Models\M_Sub_Kegiatan;

class C_Sub_Kegiatan extends Controller
{
    public function data_sub_kegiatan()
    {
        $data_proyek = M_Proyek::all();
        $data_sub_kegiatan = M_Sub_Kegiatan::all();
        $dr = ['data_proyek' => $data_proyek, 'data_sub_kegiatan' => $data_sub_kegiatan];
        return view('dashboard.sub_kegiatan_page', $dr);
    }
    public function get_kegiatan(Request $request)
    {
        // {'kd_proyek':kd_proyek}
        $kd_proyek = $request -> kd_proyek;
        $data_kegiatan = M_Kegiatan::where('kd_proyek', $kd_proyek) -> get();
        $dr = ['data_kegiatan' => $data_kegiatan];
        return \Response::json($dr);
    }
    public function proses_tambah(Request $request)
    {
        // {'kd_sub_kegiatan':kd_sub_kegiatan, 'nama_sub_kegiatan':nama_sub_kegiatan, 'deksripsi':deksripsi, 'kd_kegiatan':kd_kegiatan, 'kd_proyek':kd_proyek}
       $kd_sub_kegiatan = $request -> kd_sub_kegiatan;
       $nama_sub_kegiatan = $request -> nama_sub_kegiatan;
       $deksripsi = $request -> deksripsi;
       $kd_kegiatan = $request -> kd_kegiatan;
       
       $sub_kegiatan = new M_Sub_Kegiatan();
       $sub_kegiatan -> kd_sub_kegiatan = $kd_sub_kegiatan;
       $sub_kegiatan -> kd_kegiatan = $kd_kegiatan;
       $sub_kegiatan -> nama_sub_kegiatan = $nama_sub_kegiatan;
       $sub_kegiatan -> deksripsi = $deksripsi;
       $sub_kegiatan -> aktif = 'y';
       $sub_kegiatan -> save();

       $dr = ['status' => 'sukses'];
       return \Response::json($dr);
    }
}
