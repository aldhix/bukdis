<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->char('nama_lengkap',150);
            $table->char('nis',50)->unique();
            $table->string('password');
            $table->string('password_show');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('foto')->nullable();
            $table->enum('gender',['P','L'])->nullable();
            $table->char('tempat_lahir',150)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('SET NULL');
            $table->foreignId('tahun_pelajaran_id')->nullable()->constrained('tahun_pelajarans')->onDelete('SET NULL');
            $table->enum('status',['aktif','baru','alumni','keluar'])->default('aktif');
            $table->string('keterangan')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('siswas');
    }
}
