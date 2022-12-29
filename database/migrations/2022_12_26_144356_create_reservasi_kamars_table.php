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
        Schema::create('reservasi_kamars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user');
            $table->bigInteger('id_kamar');
            $table->date('tanggal_cekin');
            $table->date('tanggal_cekout');
            $table->float('biaya');
            $table->string('metode_pembayaran');
            $table->Boolean('status_pembayaran')->default(false);
            $table->string('status_transaksi')->nullable();
            $table->text('bukti_pembayaran')->nullable();
            $table->tinyInteger('is_extra_bed')->default(0);
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
        Schema::dropIfExists('reservasi_kamars');
    }
};
