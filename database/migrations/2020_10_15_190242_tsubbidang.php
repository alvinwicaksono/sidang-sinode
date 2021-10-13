<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tsubbidang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsubbidang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_subBidang')->unique();
            $table->string('nama_subBidang');
            $table->bigInteger('bidang_id')->unsigned();
            $table->foreign('bidang_id')->references('id')->on('tbidang')->onDelete('cascade');
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
        //
    }
}
