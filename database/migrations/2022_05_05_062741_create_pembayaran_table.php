<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->date('tgl_bayar');
            $table->integer('bulan_spp');
            $table->integer('tahun_spp');
            $table->unsignedBigInteger('id_petugas');
            $table->unsignedBigInteger('id_siswa');

            $table->foreign('id_petugas')->references('id_petugas')->on('petugas');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
