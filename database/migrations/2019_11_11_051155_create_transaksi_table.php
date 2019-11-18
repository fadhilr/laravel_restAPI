<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('transaksi_id');
            $table->integer('akun_id')->unsigned();
            $table->string('tanggal');
            $table->integer('kategori_id')->unsigned();
            $table->integer('subkategori_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->string('nominal');
            $table->string('keterangan');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
