<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('PenjualanID');
            $table->string('TanggalPenjualan'); 
            $table->string('Kasir', 50); 
            $table->decimal('TotalHarga', 10,2);
            $table->unsignedBigInteger('PelangganID')->nullable();
            $table->unsignedBigInteger('ProdukID');
            $table->decimal('Pembayaran', 10,2);
            $table->decimal('Kembalian', 10,2);

            $table->softDeletes();
            
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
        Schema::dropIfExists('penjualans');
    }
}
