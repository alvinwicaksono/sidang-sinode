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
            $table->integer('sidang_id');
            $table->integer('repoa_id');
            $table->integer('seksi_id');
            $table->string('judul_materi');
            $table->string('isi_materi');
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
