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
        Schema::create('pengajuan_models', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->string('trx_code', 20)->nullable();
            $table->string('pay_code', 20)->nullable();
            $table->string('nama_desa');
            $table->string('kepala_desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->integer('jumlah_penduduk');
            $table->string('nomor_wa');
            $table->string('catatan')->nullable();
            $table->integer('administration_fee')->default(5000);
            $table->integer('grand_total')->default(5000); 
            $table->string('status', 20)->default('Pending'); 
            $table->string('payment_url')->nullable(); 
            $table->dateTime('expired_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_models');
    }
};
