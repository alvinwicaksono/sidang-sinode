<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tbox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbox', function (Blueprint $table) {
            $table->id();
            $table->string('kode_box')->unique();
            $table->string('nama_box');
            $table->bigInteger('rak_id')->unsigned();
            $table->foreign('rak_id')->references('id')->on('trak')->onDelete('cascade');
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
        Schema::dropIfExists('tbox');
    }
}
