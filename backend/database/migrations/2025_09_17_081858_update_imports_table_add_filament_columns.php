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
        Schema::table('imports', function (Blueprint $table) {
            if (!Schema::hasColumn('imports', 'completed_at')) {
                $table->timestamp('completed_at')->nullable();
            }
            if (!Schema::hasColumn('imports', 'file_disk')) {
                $table->string('file_disk')->default('local');
            }
            if (!Schema::hasColumn('imports', 'file_name')) {
                $table->string('file_name')->nullable();
            }
            if (!Schema::hasColumn('imports', 'file_path')) {
                $table->string('file_path')->nullable();
            }
            if (!Schema::hasColumn('imports', 'importer')) {
                $table->string('importer');
            }
            if (!Schema::hasColumn('imports', 'processed_rows')) {
                $table->unsignedInteger('processed_rows')->default(0);
            }
            if (!Schema::hasColumn('imports', 'total_rows')) {
                $table->unsignedInteger('total_rows')->default(0);
            }
            if (!Schema::hasColumn('imports', 'successful_rows')) {
                $table->unsignedInteger('successful_rows')->default(0);
            }
            if (!Schema::hasColumn('imports', 'user_id')) {
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imports', function (Blueprint $table) {
            if (Schema::hasColumn('imports', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
            foreach (['completed_at', 'file_disk', 'file_name', 'file_path', 'importer', 'processed_rows', 'total_rows', 'successful_rows'] as $column) {
                if (Schema::hasColumn('imports', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
