<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\M_Proyek;
use App\Models\M_Hasil;
use App\Models\M_Kegiatan;

use PDF;

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
        $dr = [
            'kd_kegiatan' => $kd_kegiatan
        ];
        return \Response::json($dr);
    }

    public function hitung_cpm(Request $request)
    {
        // ambil variabel kode proyek 
        $kd_proyek = $request -> kd_proyek;
        // ambil data hasil dari model hasil dengan parameter kode proyek 
        $data_hasil = M_Hasil::where('kd_proyek', $kd_proyek) -> get();
        // buat array kosong 
        $dataR = array();
        // variabel x untuk perulangan 
        $x = 0;
        // cari nilai ES & EF menggunakan foreach (query maju)
        foreach($data_hasil as $hasil){
            $kd_kegiatan = $hasil -> kd_kegiatan;
            $durasi = $hasil -> durasi;
            // cek apakah ada pendahulu atau tidak 
            $total_pendahulu = DB::table('tbl_kegiatan_pendahulu') -> where('kd_kegiatan', $kd_kegiatan) -> count();
            if($total_pendahulu == 0){
                // jika nol maka kembalikan nila ES 0 dan EF sesuai dengan durasi 
                $ES = 0;
                $EF = $durasi;
                // update nilai ES dan EF 
                DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['es' => $ES, 'ef' => $EF]);
            }else{
                // cari nilai EF
                $data_pendahulu = DB::table('tbl_kegiatan_pendahulu') -> where('kd_kegiatan', $kd_kegiatan) -> get();
                foreach($data_pendahulu as $dp){
                    $kd_pendahulu = $dp -> kd_kegiatan_pendahulu;
                    $data_hasil_pendahulu = DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_pendahulu) -> first();
                    // $durasi_pendahulu = $data_hasil_pendahulu -> durasi;
                    $nilai_es = $data_hasil_pendahulu -> ef;
                    DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['es' => $nilai_es]);
                    $nilai_ef = $durasi + $nilai_es;
                    DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['ef' => $nilai_ef]);
                }
            }
        }
        // cari nilai LS & LF menggunakan foreach (query mundur)
        $q_mundur = DB::table('tbl_hasil') -> where('kd_proyek', $kd_proyek) -> orderBy('id', 'desc') -> get();
        foreach($q_mundur as $mundur){
            $kd_kegiatan = $mundur -> kd_kegiatan;
            $durasi = $mundur -> durasi;
            $total_penerus = DB::table('tbl_kegiatan_pendahulu') -> where('kd_kegiatan_pendahulu', $kd_kegiatan) -> count();
            if($total_penerus == 0){
                $data_ef_sendiri = DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> first();

                $LF = $data_ef_sendiri -> ef;
                DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['lf' => $LF]);
                $LS = $LF - $durasi;
                DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['ls' => $LS]);
            }else{
                $q_aktivitas_penerus = DB::table('tbl_kegiatan_pendahulu') -> where('kd_kegiatan_pendahulu', $kd_kegiatan) -> first();
                $kd_aktivitas_penerus = $q_aktivitas_penerus -> kd_kegiatan;
                // cari nilai LF
                $q_nilai_lf = DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_aktivitas_penerus) -> first();
                
                $LF = $q_nilai_lf -> ls;
                DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['lf' => $LF]);
                $LS = $LF - $durasi;
                DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['ls' => $LS]);
            }
        }
        
        // cari nilai slack
        foreach($data_hasil as $hasil){
            $kd_kegiatan = $hasil -> kd_kegiatan;
            $LF = $hasil -> lf;
            $EF = $hasil -> ef;
            $slack = $LF - $EF;
            DB::table('tbl_hasil') -> where('kd_kegiatan', $kd_kegiatan) -> update(['total_slack' => $slack]);
        }
        
        $dr = ['status' => $q_mundur];
        return \Response::json($dr);
    }

    public function export_pdf($kd_proyek)
    {
        $data_hasil = M_Hasil::where('kd_proyek', $kd_proyek) -> get();
        $data_proyek = M_Proyek::where('kd_proyek', $kd_proyek) -> first();
        $biaya_normal = M_Hasil::where('kd_proyek', $kd_proyek) -> sum('biaya_normal');
        $biaya_crash = M_Hasil::where('kd_proyek', $kd_proyek) -> sum('biaya_crash');
        $dr = ['data_hasil' => $data_hasil, 'kd_proyek' => $kd_proyek, 'data_proyek' => $data_proyek, 'biaya_normal' => $biaya_normal, 'biaya_crash' => $biaya_crash];
        $pdf = PDF::loadview('laporan_cpm', $dr);
        return $pdf -> stream('laporan-cpm.pdf');
    }


    

}
