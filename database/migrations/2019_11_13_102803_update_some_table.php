<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akun', function (Blueprint $table) {
            $table->renameColumn('akun_id', 'id');
        });
        Schema::table('kategori', function (Blueprint $table) {
            $table->renameColumn('kategori_id', 'id');
        });
        Schema::table('subkategori', function (Blueprint $table) {
            $table->renameColumn('subkategori_id', 'id');
        });
        Schema::table('tag', function (Blueprint $table) {
            $table->renameColumn('tag_id', 'id');
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
