<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tklasis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tklasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_klasis');
            $table->string('tahun_buka')->nullable();
            $table->string('kode_klasis');
            $table->string('tahun_tutup')->nullable();
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
        Schema::dropIfExists('tklasis');
    }
}
