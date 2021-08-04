<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\C_Page;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Dashboard;

Route::get('/', [C_Page::class, 'login_page']);
Route::post('/login/proses', [C_Login::class, 'proses_login']);

Route::get('/dashboard', [C_Dashboard::class, 'dashboard_page']);