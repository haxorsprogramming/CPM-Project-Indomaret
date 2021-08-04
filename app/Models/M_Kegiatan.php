<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Kegiatan extends Model
{
    protected $table = 'tbl_kegiatan';

    public $timestamps = false;

    protected $fillable = [
        'kd_kegiatan',
        'kd_proyek',
        'nama_kegiatan',
        'deksripsi',
        'aktif'
    ];

    public function proyek_data()
    {
        return $this -> belongsTo(M_Proyek::class, 'kd_proyek', 'kd_proyek');
    }
}
