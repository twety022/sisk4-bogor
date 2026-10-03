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
    Schema::table('products', function (Blueprint $table) {
        if (! Schema::hasColumn('products', 'sale_status')) {
            
            $table->string('sale_status')->default('portofolio')->after('id');
        }
        if (! Schema::hasColumn('products', 'price')) {
            $table->unsignedBigInteger('price')->nullable();
        }
        if (! Schema::hasColumn('products', 'creator_name')) {
            $table->string('creator_name')->nullable();
        }
        if (! Schema::hasColumn('products', 'contact_whatsapp')) {
            $table->string('contact_whatsapp')->nullable();
        }
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['sale_status', 'price', 'creator_name', 'contact_whatsapp']);
    });
}


};
