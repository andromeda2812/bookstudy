<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangTable extends Migration
{
    public function up(): void
    {
        Schema::create('ruang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('kapasitas');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            // Tambahkan di migration atau buat migration baru untuk menambah kolom status
            $table->boolean('status')->default(true); // true = tersedia, false = tidak tersedia

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruang');
    }
}
