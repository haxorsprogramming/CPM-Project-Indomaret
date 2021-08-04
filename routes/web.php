<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\C_Page;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Dashboard;
use App\Http\Controllers\C_Manajemen_Proyek;
use App\Http\Controllers\C_Kegiatan;

Route::get('/', [C_Page::class, 'login_page']);
Route::post('/login/proses', [C_Login::class, 'proses_login']);

Route::get('/dashboard', [C_Dashboard::class, 'dashboard_page']);
Route::get('/dashboard/beranda', [C_Dashboard::class, 'beranda_page'] );

Route::get('/dashboard/manajemen-proyek/data', [C_Manajemen_Proyek::class, 'data_proyek']);
Route::post('/dashboard/manajemen-proyek/tambah/proses', [C_Manajemen_Proyek::class, 'proses_tambah']);

Route::get('/dashboard/kegiatan/data', [C_Kegiatan::class, 'data_kegiatan']);
Route::post('/dashboard/kegiatan/tambah/proses', [C_Kegiatan::class, 'proses_tambah']);

Route::get('/logout', [C_Page::class, 'logout']);