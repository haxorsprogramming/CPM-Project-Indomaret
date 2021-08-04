<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\C_Page;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Dashboard;
use App\Http\Controllers\C_Manajemen_Proyek;
use App\Http\Controllers\C_Kegiatan;
use App\Http\Controllers\C_Sub_Kegiatan;
use App\Http\Controllers\C_Manajemen_Kegiatan;

Route::get('/', [C_Page::class, 'login_page']);
Route::post('/login/proses', [C_Login::class, 'proses_login']);

// dashboard 
Route::get('/dashboard', [C_Dashboard::class, 'dashboard_page']);
Route::get('/dashboard/beranda', [C_Dashboard::class, 'beranda_page'] );
// manajemen proyek 
Route::get('/dashboard/manajemen-proyek/data', [C_Manajemen_Proyek::class, 'data_proyek']);
Route::post('/dashboard/manajemen-proyek/tambah/proses', [C_Manajemen_Proyek::class, 'proses_tambah']);
// kegiatan 
Route::get('/dashboard/kegiatan/data', [C_Kegiatan::class, 'data_kegiatan']);
Route::post('/dashboard/kegiatan/tambah/proses', [C_Kegiatan::class, 'proses_tambah']);
Route::post('/dashboard/kegiatan/get-kegiatan', [C_Kegiatan::class, 'get_kegiatan']);
// sub kegiatan 
Route::get('/dashboard/sub-kegiatan/data', [C_Sub_Kegiatan::class, 'data_sub_kegiatan']);
Route::post('/dashboard/sub-kegiatan/get-kegiatan', [C_Sub_Kegiatan::class, 'get_kegiatan']);
Route::post('/dashboard/sub-kegiatan/tambah/proses', [C_Sub_Kegiatan::class, 'proses_tambah']);
// manajemen kegiatan 
Route::get('/dashboard/manajemen-kegiatan/data', [C_Manajemen_Kegiatan::class, 'data_manajemen_kegiatan']);
Route::get('/dashboard/manajemen-kegiatan/detail/{proyek}', [C_Manajemen_Kegiatan::class, 'detail_manajemen_kegiatan']);
Route::post('/dashboard/manajemen-kegiatan/cpm/proses', [C_Manajemen_Kegiatan::class, 'proses_cpm']);
Route::post('/dashboard/manajemen-kegiatan/cpm/hitung', [C_Manajemen_Kegiatan::class, 'hitung_cpm']);

Route::get('/logout', [C_Page::class, 'logout']);