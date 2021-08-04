<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblHitungSubKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hitung_sub_kegiatan', function (Blueprint $table) {
            $table -> id();
            $table -> char('kd_sub_kegiatan', 20);
            $table -> date('mulai') -> nullable();
            $table -> date('selesai') -> nullable();
            $table -> integer('biaya_normal');
            $table -> integer('biaya_crash');
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
        Schema::dropIfExists('tbl_hitung_sub_kegiatan');
    }
}
