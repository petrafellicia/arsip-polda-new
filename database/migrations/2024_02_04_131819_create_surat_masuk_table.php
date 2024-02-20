<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_agenda');
            $table->string('nomor_surat');
            $table->unsignedBigInteger('jenis_surat');
            $table->unsignedBigInteger('asal_surat');
            $table->text('perihal');
            $table->unsignedBigInteger('kka');
            $table->date('tanggal_surat');
            $table->time('jam_surat');
            $table->string('disposisi_kepada');
            $table->unsignedBigInteger('penerima');
            $table->string('isi_disposisi');
            $table->text('keterangan')->nullable();
            $table->string('file_name');
            $table->timestamps();
            // $table->enum('jenis_surat', [
            //     'Surat Biasa',
            //     'Nota Dinas',
            //     'Telegram',
            //     'Sprin',
            //     'Surat Izin',
            //     'Surat Rahasia'
            // ]);


            $table->foreign('kka')->references('id')->on('kka');
            $table->foreign('jenis_surat')->references('id')->on('jenis_surat');
            $table->foreign('penerima')->references('id')->on('unit_penerima');
            $table->foreign('asal_surat')->references('id')->on('pengirim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
