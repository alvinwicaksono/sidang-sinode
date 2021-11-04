<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepoAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repo_as', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sidang_id')->unsigned();
            $table->foreign('sidang_id')->references('id')->on('sidangs');
            $table->longText('judul_materi');
            $table->longText('isi_materi')->nullable();
            $table->longText('sumber_materi')->nullable();
            $table->longText('attachment')->nullable();
            $table->string('status');
            $table->bigInteger('count')->nullable();
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
        Schema::dropIfExists('repo_as');
    }
}
