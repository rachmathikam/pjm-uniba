<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriSubKategoriDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_sub_kategori_dokumens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_dokumen_id');
            $table->unsignedBigInteger('sub_kategori_dokumen_id');

            $table->foreign('kategori_dokumen_id')->references('id')->on('kategori_dokumens')->onDelete('cascade');
            $table->foreign('sub_kategori_dokumen_id')->references('id')->on('sub_kategori_dokumens')->onDelete('cascade');
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
        Schema::dropIfExists('kategori_sub_kategori_dokumens');
    }
}
