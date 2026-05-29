<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_hash', 64);
            $table->string('uri', 255);
            $table->string('referer', 255)->nullable();
            $table->string('device', 50)->default('Desktop');
            $table->string('platform', 50)->nullable();
            $table->string('browser', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
