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
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan')->unique();
            $table->string('syarat1')->nullable();
            $table->string('syarat2')->nullable();
            $table->string('syarat3')->nullable();
            $table->string('syarat4')->nullable();
            $table->string('syarat5')->nullable();
            $table->string('syarat6')->nullable();
            $table->string('syarat7')->nullable();
            $table->string('syarat8')->nullable();
            $table->string('syarat9')->nullable();
            $table->string('syarat10')->nullable();
            $table->string('status')->default(1);
            $table->foreignId('instansi_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
