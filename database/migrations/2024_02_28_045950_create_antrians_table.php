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
            $table->string('nama')->nullable();
            $table->bigInteger('nik')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->integer('status')->nullable();
            $table->integer('survei')->nullable();
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
