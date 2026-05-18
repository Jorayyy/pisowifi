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
        Schema::create('sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('device_id')->constrained('devices');
            $table->foreignUuid('voucher_id')->nullable()->constrained('vouchers');
            $table->string('mac_address');
            $table->timestamp('started_at');
            $table->timestamp('ends_at')->nullable();
            $table->integer('data_limit')->nullable()->comment('MB');
            $table->integer('data_used')->default(0)->comment('MB');
            $table->enum('status', ['active', 'expired', 'paused'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
