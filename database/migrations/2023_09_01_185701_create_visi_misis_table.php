<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisiMisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori',['visi','misi','tujuan']);
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
        Schema::dropIfExists('visi_misis');
    }
}
