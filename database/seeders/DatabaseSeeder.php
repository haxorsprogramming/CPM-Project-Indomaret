<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this -> add_user();
    }

    function add_user()
    {
        $now = Carbon::now();
        DB::table('tbl_user') -> insert([
            'username' => 'admin',
            'kata_sandi' => md5('admin'),
            'tipe_user' => 'admin',
            'last_login' => $now,
            'aktif' => '1'
        ]);
    }
}
