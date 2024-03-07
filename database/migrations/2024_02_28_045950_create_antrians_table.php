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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id');
            $table->string('no_antri');
            $table->string('nama');
            $table->bigInteger('nik')->nullable();
            $table->bigInteger('no_hp')->nullable();
            $table->string('ttl')->nullable();
            $table->string('gender')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
