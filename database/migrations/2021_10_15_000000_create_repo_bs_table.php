<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepoBsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repo_bs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sidang_id')->unsigned();
            $table->foreign('sidang_id')->references('id')->on('sidangs');
            $table->bigInteger('repoa_id')->unsigned();
            $table->foreign('repoa_id')->references('id')->on('repo_as');
            $table->bigInteger('seksi_id')->unsigned();
            $table->foreign('seksi_id')->references('id')->on('seksis');
            $table->longText('judul_materi');
            $table->longText('isi_materi');
            $table->longText('attachment')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('repo_bs');
    }
}
