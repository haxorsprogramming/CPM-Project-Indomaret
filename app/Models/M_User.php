<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_User extends Model
{
    protected $table = 'tbl_user';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'kata_sandi',
        'tipe_user',
        'last_login',
        'aktif'
    ];

}
