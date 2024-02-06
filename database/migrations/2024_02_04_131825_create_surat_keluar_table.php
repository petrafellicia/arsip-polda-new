<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_agenda');
            $table->string('nomor_surat');
            $table->unsignedBigInteger('jenis_surat');
            $table->unsignedBigInteger('pengirim');
            $table->text('perihal');
            $table->unsignedBigInteger('kka');
            $table->string('dasar_surat');
            $table->date('tanggal_surat');
            $table->time('jam_surat');
            $table->unsignedBigInteger('tujuan');
            $table->string('feedback')->nullable();
            $table->string('file_name');
            $table->timestamps();


            $table->foreign('kka')->references('id')->on('kka');
            $table->foreign('jenis_surat')->references('id')->on('jenis_surat');
            $table->foreign('pengirim')->references('id')->on('unit_penerima');
            $table->foreign('tujuan')->references('id')->on('tujuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
