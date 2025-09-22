<?php

// database/migrations/xxxx_xx_xx_create_weddings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();

            // Bride
            $table->string('bride_name');
            $table->string('bride_nickname')->nullable();
            $table->string('bride_photo')->nullable();
            $table->string('bride_father_name')->nullable();
            $table->string('bride_mother_name')->nullable();

            // Groom
            $table->string('groom_name');
            $table->string('groom_nickname')->nullable();
            $table->string('groom_photo')->nullable();
            $table->string('groom_father_name')->nullable();
            $table->string('groom_mother_name')->nullable();

            // Akad
            $table->date('akad_date')->nullable();
            $table->time('akad_start_time')->nullable();
            $table->time('akad_end_time')->nullable();
            $table->string('akad_place')->nullable();

            // Reception 1
            $table->date('reception1_date')->nullable();
            $table->time('reception1_start_time')->nullable();
            $table->time('reception1_end_time')->nullable();
            $table->string('reception1_place')->nullable();

            // Reception 2
            $table->date('reception2_date')->nullable();
            $table->time('reception2_start_time')->nullable();
            $table->time('reception2_end_time')->nullable();
            $table->string('reception2_place')->nullable();

            // Maps
            $table->string('maps_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
