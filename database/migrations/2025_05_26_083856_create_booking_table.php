<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');    // user yang melakukan booking
            $table->unsignedBigInteger('ruang_id');   // ruang yang dibooking
            $table->date('tanggal_booking');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->text('tujuan');
            $table->string('upload_ktm')->nullable(); // path file KTM yang diupload
            $table->timestamps();

            // foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ruang_id')->references('id')->on('ruang')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
}
