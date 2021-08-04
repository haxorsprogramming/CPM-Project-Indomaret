<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\M_Proyek;
use App\Models\M_Hasil;
use App\Models\M_Kegiatan;

class C_Manajemen_Kegiatan extends Controller
{
    public function data_manajemen_kegiatan()
    {
        $data_proyek = M_Proyek::all();
        $dr = ['data_proyek' => $data_proyek];
        return view('dashboard.manajemen_kegiatan_page', $dr);
    }

    public function detail_manajemen_kegiatan($proyek)
    {
        $kd_proyek = $proyek;
        $data_hasil = M_Hasil::where('kd_proyek', $kd_proyek) -> get();
        $data_kegiatan = M_Kegiatan::where('kd_proyek', $kd_proyek) -> get();
        $dr = ['data_hasil' => $data_hasil, 'data_kegiatan' => $data_kegiatan, 'kd_proyek' => $kd_proyek];
        return view('dashboard.data_manajemen_kegiatan', $dr);
    }

    public function proses_cpm(Request $request)
    {
        // {'kd_kegiatan':kd_kegiatan, 'biaya_crash':biaya_crash, 'biaya_normal':biaya_normal, 'mulai':mulai, 'selesai':selesai}
        $kd_kegiatan = $request -> kd_kegiatan;
        $mulai = date_create($request -> mulai);
        $selesai = date_create($request -> selesai);
        $selisih_arr = date_diff($mulai, $selesai);
        $selisih_final = $selisih_arr -> d;
        $biaya_normal = $request -> biaya_normal;
        $biaya_crash = $request -> biaya_crash;
        DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['durasi' => $selisih_final, 'mulai' => $mulai, 'selesai' => $selesai, 'biaya_normal' => $biaya_normal, 'biaya_crash' => $biaya_crash]);
        // // cari durasi 
        // $data_hasil = M_Hasil::where('kd_kegiatan', $kd_kegiatan) -> first();
        // $durasi = $data_hasil -> durasi;
        $dr = [
            'kd_kegiatan' => $kd_kegiatan
        ];
        return \Response::json($dr);
    }

    public function hitung_cpm(Request $request)
    {
        $kd_proyek = $request -> kd_proyek;
        $data_hasil = M_Hasil::where('kd_proyek', $kd_proyek) -> get();
        $dataR = array();
        foreach($data_hasil as $hasil){
            $kd_kegiatan = $hasil -> kd_kegiatan;
            $durasi = $hasil -> durasi;
            // cek apakah ada pendahulu atau tidak 
            $total_pendahulu = DB::table('tbl_kegiatan_pendahulu') -> where('kd_kegiatan', $kd_kegiatan) -> count();
            if($total_pendahulu === 0){
                $ES = 0;
            }else{
                $data_pendahulu = DB::table('tbl_kegiatan_pendahulu') -> where('kd_kegiatan', $kd_kegiatan) -> get();
                $arr_pendahulu = array();
                foreach($data_pendahulu as $dp){
                    $kd_pendahulu = $dp -> kd_kegiatan_pendahulu;
                    // cari durasi kegiatan pendahulu 
                    $dur_pendahulu = DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_pendahulu) -> first();
                    $durasi_pendahulu = $dur_pendahulu -> durasi;
                    array_push($arr_pendahulu, $durasi_pendahulu);
                    $ES = max($arr_pendahulu);
                }
            }
            $arrTemp['ES'] = $ES;
            $arrTemp['kd_kegiatan'] = $kd_kegiatan;
            // cari pendahulu
            $dataR[] = $arrTemp;
        }
        $dr = [
            'status' => $kd_proyek,
            'data_hasil' => $dataR
        ];
        return \Response::json($dr);
    }

}
