<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hasil_suaras', function (Blueprint $table) {
            $table->id();
            $table->string('tps')->foreign()->refrerences('id')->on('tps');
            $table->integer('paslon1');
            $table->integer('kotak_kosong');
            $table->string('Status');
            $table->integer('suara_tidak_sah');
            $table->integer('jumlah_kehadiran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_suara');
    }
};
