<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\C_Page;

Route::get('/', [C_Page::class, 'login_page']);
