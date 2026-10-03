<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini menyimpan data statistik sekolah yang tampil
     * di section angka-angka (contoh: 1.079+ Siswa, 56+ Guru & Staff)
     */
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('label');          // contoh: "Siswa Aktif"
            $table->string('value');           // contoh: "1.079+"
            $table->string('icon')->nullable(); // contoh: "bi-people-fill" (Bootstrap Icons)
            $table->unsignedInteger('order')->default(0); // urutan tampil
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
