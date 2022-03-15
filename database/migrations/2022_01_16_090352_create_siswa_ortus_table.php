<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaOrtusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_ortus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->enum('type_ortu',['ayah','ibu','wali']);
            $table->char('nama_lengkap_ortu',150)->nullable();
            $table->string('foto_ortu')->nullable();
            $table->char('tempat_lahir_ortu',150)->nullable();
            $table->date('tgl_lahir_ortu')->nullable();
            $table->char('agama_ortu',150)->nullable();
            $table->string('alamat_ortu')->nullable();
            $table->char('no_hp_ortu',150)->nullable();
            $table->char('pend_akhir_ortu',150)->nullable();
            $table->char('pekerjaan_ortu',150)->nullable();
            $table->string('alamat_pekerjaan_ortu')->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_ortus');
    }
}
