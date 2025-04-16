<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->bigIncrements('PelangganID');
            $table->string('NamaPelanggan'); 
            $table->text('Alamat');
            $table->string('Notelp', 15);      
            $table->string('Email')->unique(); // Tambahkan email dengan unique constraint
            $table->enum('JenisKelamin', ['Laki-laki', 'Perempuan']); // Jenis Kelamin
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
        Schema::dropIfExists('pelanggans');
    }
}