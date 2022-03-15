<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->char('nisn',50)->nullable();
            $table->char('nama_panggilan',100)->nullable();
            $table->tinyInteger('anak_ke')->nullable();
            $table->tinyInteger('jum_saudara')->nullable();
            $table->char('agama',150)->nullable();
            $table->char('gol_darah',5)->nullable();
            $table->char('bahasa',150)->nullable();
            $table->char('negara',150)->nullable();
            $table->string('alamat')->nullable();
            $table->char('no_hp',50)->nullable();
            $table->char('tinggal_dgn',150)->nullable();
            $table->string('alasan_tidak_tinggal')->nullable();
            $table->string('lingkungan')->nullable();
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
        Schema::dropIfExists('siswa_details');
    }
}
