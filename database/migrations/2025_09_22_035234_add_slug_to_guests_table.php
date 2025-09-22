<?php

use App\Models\Guest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            Schema::table('guests', function (Blueprint $table) {
                $table->string('slug')->unique()->after('name')->nullable();
            });
    
            // Isi slug otomatis dari name untuk data existing
            Guest::all()->each(function ($guest) {
                $guest->slug = Str::slug($guest->name);
                $guest->save();
            });
    
            // Tambahkan index gabungan session + slug biar query cepat
            Schema::table('guests', function (Blueprint $table) {
                $table->index(['session', 'slug']);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropIndex(['session', 'slug']);
            $table->dropColumn('slug');
        });
    }
};
