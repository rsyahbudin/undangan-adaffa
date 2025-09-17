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
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->datetime('wedding_date');
            $table->boolean('is_active')->default(true);
            $table->string('invitation_code')->unique();
            $table->string('cover_photo')->nullable();
            $table->string('background_photo')->nullable();
            $table->string('background_music')->nullable();
            $table->date('countdown_date')->nullable();
            $table->datetime('countdown_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
