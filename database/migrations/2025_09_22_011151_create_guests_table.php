<?php

// database/migrations/xxxx_xx_xx_create_guests_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('session')->comment('1 = Akad + Resepsi 1, 2 = Akad + Resepsi 2');
            $table->integer('guest_count')->default(1);
            $table->boolean('is_invited')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('guests');
    }
};

