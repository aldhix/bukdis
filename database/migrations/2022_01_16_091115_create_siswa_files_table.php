<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->string('file_kk')->nullable();
            $table->string('file_ktp_ayah_ibu')->nullable();
            $table->string('file_ktp_wali')->nullable();
            $table->string('file_akta_lahir')->nullable();
            $table->string('file_ijazah_smp')->nullable();
            $table->string('file_ijazah_sd')->nullable();
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
        Schema::dropIfExists('siswa_files');
    }
}
