<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->string('kk');
            $table->string('nama')->nullable();
            $table->string('jk')->nullable();
            $table->string('tmpt_lhr')->nullable();
            $table->string('tgl_lhr')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('kota')->nullable();
            $table->string('kec')->nullable();
            $table->string('kel')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('password');
            $table->string('no_hp')->nullable();
            $table->string('api_token',80)->unique()->nullable()->default(null);
            $table->string('fcm_token')->nullable();
            $table->string('no_rek')->nullable();
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
        Schema::table('waris', function (Blueprint $table) {
            $table->dropColumn('api_token');
        });
        Schema::dropIfExists('waris');
    }
}
