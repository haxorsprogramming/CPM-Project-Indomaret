<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Kegiatan_Pendahulu extends Model
{
    protected $table = 'tbl_kegiatan_pendahulu';

    public $timestamps = false;

    protected $fillable = [
        'kd_proyek',
        'kd_kegiatan',
        'kd_kegiatan_pendahulu',
        'aktif'
    ];

}
