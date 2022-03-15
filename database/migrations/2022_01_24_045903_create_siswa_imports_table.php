<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_imports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id');
            $table->char('nama_lengkap',150);
            $table->char('nis',50)->unique();
            $table->string('password');
            $table->string('password_show');
            $table->enum('gender',['P','L'])->nullable();

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
        Schema::dropIfExists('siswa_imports');
    }
}
