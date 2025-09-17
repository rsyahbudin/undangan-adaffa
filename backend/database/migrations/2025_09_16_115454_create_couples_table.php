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
        Schema::create('couples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
            $table->string('groom_name');
            $table->string('groom_nickname')->nullable();
            $table->string('groom_photo')->nullable();
            $table->string('groom_father_name')->nullable();
            $table->string('groom_mother_name')->nullable();
            $table->string('bride_name');
            $table->string('bride_nickname')->nullable();
            $table->string('bride_photo')->nullable();
            $table->string('bride_father_name')->nullable();
            $table->string('bride_mother_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couples');
    }
};
