<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('principal_name')->nullable()->after('about_video');
            $table->text('principal_message')->nullable()->after('principal_name');
            $table->string('principal_image')->nullable()->after('principal_message');
            $table->text('education_commitment')->nullable()->after('mission');
        });
    }

    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'principal_name',
                'principal_message',
                'principal_image',
                'education_commitment',
            ]);
        });
    }
};