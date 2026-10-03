<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb_infos', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year')->nullable();  
            $table->text('intro_content')->nullable();     
            $table->json('requirements')->nullable();       
            $table->string('registration_url')->nullable(); 
            $table->string('contact_whatsapp')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('brochure_file')->nullable();   
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_infos');
    }
};
