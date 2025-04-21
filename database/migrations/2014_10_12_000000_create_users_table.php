<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user');  // Menggunakan enum untuk role 'admin' dan 'user'
            $table->string('password');
            $table->string('alamat'); // kolom alamat
            $table->string('no_telp'); // kolom nomor telepon
            $table->enum('status', ['bekerja', 'tidak bekerja'])->default('bekerja','tidak bekerja'); // kolom stat
            $table->boolean('is_active')->default(false); // true artinya masih aktif

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
