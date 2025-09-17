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
        Schema::table('media', function (Blueprint $table) {
            $table->string('youtube_url')->nullable()->after('file_url');
            $table->dropColumn(['file_size', 'mime_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->bigInteger('file_size')->nullable();
            $table->string('mime_type')->nullable();
            $table->dropColumn('youtube_url');
        });
    }
};
