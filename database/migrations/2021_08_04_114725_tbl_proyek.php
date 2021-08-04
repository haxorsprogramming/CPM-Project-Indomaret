<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_proyek', function (Blueprint $table) {
            $table -> id();
            $table -> char('kd_proyek', 20);
            $table -> char('nama_proyek', 200);
            $table -> text('deksripsi');
            $table -> date('mulai') -> nullable();
            $table -> date('selesai') -> nullable();
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
        Schema::dropIfExists('tbl_proyek');
    }
}
