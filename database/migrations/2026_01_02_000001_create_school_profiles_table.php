<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->text('about_content')->nullable();   
            $table->string('about_image')->nullable();
            $table->string('about_video')->nullable();  
            $table->text('vision')->nullable();           
            $table->json('mission')->nullable();          
            $table->text('history_content')->nullable();  
            $table->string('history_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
