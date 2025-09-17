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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['akad', 'resepsi_1', 'resepsi_2']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date');
            $table->datetime('time');
            $table->string('location');
            $table->text('address')->nullable();
            $table->string('maps_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
