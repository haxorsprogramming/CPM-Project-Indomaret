<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kegiatan', function (Blueprint $table) {
            $table -> id();
            $table -> char('kd_kegiatan', 20);
            $table -> char('kd_proyek', 20);
            $table -> char('nama_kegiatan', 200);
            $table -> text('deksripsi');
            $table -> char('aktif', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kegiatan');
    }
}
