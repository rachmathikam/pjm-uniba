<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTupoksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tupoksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sub_kategori')->references('id')->on('kategori_sub_kategori')->onDelete('cascade');
            $table->enum('status',['publish','non_publish'])->default('non_publish');
            $table->string('deskripsi');
            $table->date('tanggalmasuk');
            $table->date('tanggalkeluar');
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
        Schema::dropIfExists('tupoksis');
    }
}
