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
        Schema::create('saving_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('platform_name');
            $table->decimal('target', 15, 2);
            $table->string('purpose')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->string('duration')->nullable();
            $table->string('time_line')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_plans');
    }
};
