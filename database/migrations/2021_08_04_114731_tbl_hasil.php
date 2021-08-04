<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblHasil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hasil', function (Blueprint $table) {
            $table -> id();
            $table -> char('kd_kegiatan', 20);
            $table -> char('kd_proyek');
            $table -> integer('durasi') -> nullable();
            $table -> date('mulai') -> nullable();
            $table -> date('selesai') -> nullable();
            $table -> integer('es') -> nullable();
            $table -> integer('lf') -> nullable();
            $table -> integer('ef') -> nullable();
            $table -> integer('ls') -> nullable();
            $table -> integer('total_slack') -> nullable();
            $table -> integer('free_slack') -> nullable();
            $table -> integer('biaya_normal') -> nullable();
            $table -> integer('biaya_crash') -> nullable();
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
        Schema::dropIfExists('tbl_hasil');
    }
}
