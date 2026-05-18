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
        Schema::create('device_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('device_id')->constrained('devices')->onDelete('cascade');
            $table->float('cpu_usage')->nullable();
            $table->float('ram_usage')->nullable();
            $table->float('temperature')->nullable();
            $table->integer('connected_users')->default(0);
            $table->integer('uptime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_metrics');
    }
};
