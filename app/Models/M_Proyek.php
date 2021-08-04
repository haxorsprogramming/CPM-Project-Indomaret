<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Proyek extends Model
{
    protected $table = 'tbl_proyek';

    public $timestamps = false;

    protected $fillable = [
        'kd_proyek',
        'nama_proyek',
        'deksripsi',
        'mulai',
        'selesai',
        'aktif'
    ];
}
