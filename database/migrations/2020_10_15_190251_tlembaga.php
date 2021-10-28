<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tlembaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlembaga', function (Blueprint $table) {
            $table->id();
            $table->string("kode_lembaga")->unique();
            $table->string('nama_lembaga');
            $table->date('tgl_berdiri');
            $table->string('alamat');
            $table->string('status');
            $table->bigInteger('klasis_id')->unsigned();
            $table->foreign('klasis_id')->references('id')->on('tklasis')->onDelete('cascade');
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
        Schema::dropIfExists('tlembaha');
    }
}
