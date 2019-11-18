<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelasiTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('akun_id')->unsigned()->change();
            $table->foreign('akun_id')->references('akun_id')->on('akun')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('kategori_id')->unsigned()->change();
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('subkategori_id')->unsigned()->change();
            $table->foreign('subkategori_id')->references('subkategori_id')->on('subkategori')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->change();
            $table->foreign('tag_id')->references('tag_id')->on('tag')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
