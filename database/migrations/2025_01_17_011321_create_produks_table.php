<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('ProdukID');
            $table->string('NamaProduk', 50); 
            $table->decimal('Harga', 10,2);
            $table->integer('Stok');
            $table->date('exp_date'); 
            $table->unsignedBigInteger('CategoryID');
            $table->unsignedBigInteger('SuplierID');           
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
        Schema::dropIfExists('produks');
    }
}
