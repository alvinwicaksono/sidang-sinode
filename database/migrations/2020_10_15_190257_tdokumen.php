<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tdokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdokumen', function (Blueprint $table) {
            $table->id();
            $table->integer('jumdok');
            $table->string('batas_akses');
            $table->string('nama_dokumen');
            $table->string('keterangan');
            $table->date('tanggal_buat');
            $table->string('pengarang');
            $table->string('kode_dokumen')->unique();
            $table->date('tanggal_masuk');
            $table->bigInteger('lembaga_id')->unsigned();
            $table->foreign('lembaga_id')->references('id')->on('tlembaga')->onDelete('cascade');
            $table->bigInteger('box_id')->unsigned();
            $table->foreign('box_id')->references('id')->on('tbox')->onDelete('cascade');
            $table->bigInteger('subbidang_id')->unsigned();
            $table->foreign('subbidang_id')->references('id')->on('tsubbidang')->onDelete('cascade');
            $table->bigInteger('format_id')->unsigned();
            $table->foreign('format_id')->references('id')->on('tformat')->onDelete('cascade');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdokumen');
    }
}
