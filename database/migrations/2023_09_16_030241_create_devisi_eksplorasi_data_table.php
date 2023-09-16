<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisiEksplorasiDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devisi_eksplorasi_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sub_kategori_id')->references('id')->on('kategori_sub_kategori')->onDelete('cascade');
            $table->enum('status',['publish','non_publish'])->default('non_publish');
            $table->string('deskripsi');
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
        Schema::dropIfExists('devisi_eksplorasi_data');
    }
}
