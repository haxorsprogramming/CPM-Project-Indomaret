<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Sub_Kegiatan extends Model
{
    protected $table = 'tbl_sub_kegiatan';

    public $timestamps = false;

    protected $fillable = [
        'kd_sub_kegiatan',
        'kd_kegiatan',
        'nama_sub_kegiatan',
        'deksripsi',
        'aktif'
    ];

    public function kegiatan_data()
    {
        return $this -> belongsTo(M_Kegiatan::class, 'kd_kegiatan', 'kd_kegiatan');
    }

}
