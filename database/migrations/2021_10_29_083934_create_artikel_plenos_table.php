<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelPlenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel_plenos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sidang_id')->unsigned();
            $table->foreign('sidang_id')->references('id')->on('sidangs')->onDelete('cascade');
            $table->bigInteger('repob_id')->unsigned()->nullable();
            $table->foreign('repob_id')->references('id')->on('repo_bs')->onDelete('cascade'); 
            $table->bigInteger('nomor_artikel')->unsigned()->nullable();
            $table->bigInteger('nomor_artikel_seksi')->unsigned()->nullable();
            $table->bigInteger('seksi_id')->unsigned();
            $table->foreign('seksi_id')->references('id')->on('seksis');
            $table->bigInteger('peserta_id')->unsigned();
            $table->foreign('peserta_id')->references('id')->on('peserta_sidangs');
            $table->TEXT('judul');
            $table->TEXT('setelah_sidang_bahas')->nullable();
            $table->TEXT('Mengingat')->nullable();
            $table->TEXT('Mempertimbangkan')->nullable();
            $table->TEXT('Memutuskan')->nullable();
            $table->string('lampiran')->nullable();
            $table->boolean('verified')->default(0);
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
        Schema::dropIfExists('artikel_plenos');
    }
}