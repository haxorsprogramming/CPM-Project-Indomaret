<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKegiatanPendahulu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kegiatan_pendahulu', function (Blueprint $table) {
            $table -> id();
            $table -> char('kd_proyek', 20);
            $table -> char('kd_kegiatan', 20);
            $table -> char('kd_kegiatan_pendahulu', 20);
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
        Schema::dropIfExists('tbl_kegiatan_pendahulu');
    }
}
