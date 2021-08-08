<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_Kegiatan;
use App\Models\M_Proyek;
use App\Models\M_Kegiatan_Pendahulu;
use App\Models\M_Hasil;

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

    public function get_kegiatan(Request $request)
    {
        $kd_proyek = $request -> kd_proyek;
        $data_kegiatan = M_Kegiatan::where('kd_proyek', $kd_proyek) -> get();
        $dr = ['data_kegiatan' => $data_kegiatan];
        return \Response::json($dr);
    }

    public function proses_tambah(Request $request)
    {
        $kd_kegiatan = $request -> kd_kegiatan;
        $nama_kegiatan = $request -> nama_kegiatan;
        $deksripsi = $request -> deksripsi;
        $kd_proyek = $request -> kd_proyek;
        $kd_kp1 = $request -> kd_kp1;
        $kd_kp2 = $request -> kd_kp2;
        $kd_kp3 = $request -> kd_kp3;

        $kegiatan = new M_Kegiatan();
        $kegiatan -> kd_kegiatan = $kd_kegiatan;
        $kegiatan -> kd_proyek = $kd_proyek;
        $kegiatan -> nama_kegiatan = $nama_kegiatan;
        $kegiatan -> deksripsi = $deksripsi;
        $kegiatan -> aktif = 'y';
        $kegiatan -> save();

        if($kd_kp1 == 'no'){
            
        }else{
            $kegiatan_pendahulu = new M_Kegiatan_Pendahulu();
            $kegiatan_pendahulu -> kd_proyek = $kd_proyek;
            $kegiatan_pendahulu -> kd_kegiatan = $kd_kegiatan;
            $kegiatan_pendahulu -> kd_kegiatan_pendahulu = $kd_kp1;
            $kegiatan_pendahulu -> aktif = 'y';
            $kegiatan_pendahulu -> save();
        }

        if($kd_kp2 == 'no'){
            
        }else{
            $kegiatan_pendahulu = new M_Kegiatan_Pendahulu();
            $kegiatan_pendahulu -> kd_proyek = $kd_proyek;
            $kegiatan_pendahulu -> kd_kegiatan = $kd_kegiatan;
            $kegiatan_pendahulu -> kd_kegiatan_pendahulu = $kd_kp2;
            $kegiatan_pendahulu -> aktif = 'y';
            $kegiatan_pendahulu -> save();
        }

        if($kd_kp3 == 'no'){

        }else{
            $kegiatan_pendahulu = new M_Kegiatan_Pendahulu();
            $kegiatan_pendahulu -> kd_proyek = $kd_proyek;
            $kegiatan_pendahulu -> kd_kegiatan = $kd_kegiatan;
            $kegiatan_pendahulu -> kd_kegiatan_pendahulu = $kd_kp3;
            $kegiatan_pendahulu -> aktif = 'y';
            $kegiatan_pendahulu -> save();
        }

        $hasil = new M_Hasil();
        $hasil -> kd_kegiatan = $kd_kegiatan;
        $hasil -> kd_proyek = $kd_proyek;
        $hasil -> durasi = 0;
        $hasil -> aktif = 'y';
        $hasil -> save();

        $dr = ['status' => 'sukses'];
        return \Response::json($dr);
    }


    

}
