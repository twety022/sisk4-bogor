<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini menyimpan Berita & Pengumuman SISK4
     * yang tampil di section "Berita & Pengumuman SISK4"
     */
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->default('berita'); 
            $table->string('category')->default('kegiatan'); 
            $table->json('tags')->nullable();            
            $table->text('excerpt')->nullable();        
            $table->longText('content')->nullable();    
            $table->text('pull_quote')->nullable();     
            $table->string('image')->nullable();       
            $table->boolean('is_featured')->default(false); 
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
