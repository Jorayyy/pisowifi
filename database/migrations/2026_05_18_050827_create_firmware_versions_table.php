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
        Schema::create('firmware_versions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('version')->unique();
            $table->string('file_path');
            $table->string('checksum')->nullable();
            $table->text('changelog')->nullable();
            $table->boolean('is_stable')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firmware_versions');
    }
};
