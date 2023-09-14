<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusPersonaliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus_personalias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sub_kategori_id')->references('id')->on('kategori_sub_kategori')->onDelete('cascade');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto');
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
        Schema::dropIfExists('pengurus_personalias');
    }
}
