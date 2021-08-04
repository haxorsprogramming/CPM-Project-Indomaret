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
            $table -> char('kd_proyek', 20);
            $table -> integer('durasi');
            $table -> date('mulai') -> nullable();
            $table -> date('selesai') -> nullable();
            $table -> integer('es');
            $table -> integer('lf');
            $table -> integer('ef');
            $table -> integer('total_stack');
            $table -> integer('free_slack');
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
        Schema::dropIfExists('tbl_hasil');
    }
}
