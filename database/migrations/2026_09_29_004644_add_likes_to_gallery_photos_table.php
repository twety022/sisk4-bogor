public function up(): void
{
    if (! Schema::hasColumn('gallery_photos', 'likes')) {
        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->unsignedInteger('likes')->default(0)->after('is_active');
        });
    }
}

public function down(): void
{
    Schema::table('gallery_photos', function (Blueprint $table) {
        $table->dropColumn('likes');
    });
}