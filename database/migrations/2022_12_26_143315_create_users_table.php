<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('password');
            $table->string('email');
            $table->string('nama_lengkap')->nullable();
            $table->string('alamat')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->bigInteger('id_role');
            $table->string('kewarganegaraan')->nullable();
            $table->string('nohp')->nullable();
            $table->boolean('isdeleted')->default(false);
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
};
