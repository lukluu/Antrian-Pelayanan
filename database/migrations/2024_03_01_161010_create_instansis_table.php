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
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nama_kepanjangan')->nullable();
            $table->string('kode')->nullable();
            $table->string('sektor')->nullable();
            $table->string('logo')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->integer('aktif')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};
