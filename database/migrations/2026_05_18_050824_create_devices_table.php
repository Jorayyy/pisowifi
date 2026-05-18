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
        Schema::create('devices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('franchise_id')->constrained('franchises');
            $table->string('serial_number')->unique();
            $table->string('mac_address')->unique();
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('firmware_version')->nullable();
            $table->enum('status', ['online', 'offline', 'maintenance'])->default('offline');
            $table->timestamp('last_heartbeat')->nullable();
            $table->json('config')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
