<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Hasil extends Model
{
    protected $table = 'tbl_hasil';

    public $timestamps = false;

    protected $fillable = [
        'kd_kegiatan',
        'durasi',
        'mulai',
        'selesai',
        'es',
        'lf',
        'ef',
        'ls',
        'total_slack',
        'free_slack',
        'biaya_normal',
        'biaya_crash',
        'aktif'
    ];

    public function kegiatan_data()
    {
        return $this -> belongsTo(M_Kegiatan::class, 'kd_kegiatan', 'kd_kegiatan');
    }

}
