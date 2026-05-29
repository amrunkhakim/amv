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
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->index('created_at');
            $table->index(['created_at', 'ip_hash']);
            $table->index(['created_at', 'browser']);
            $table->index(['created_at', 'uri']);
            $table->index(['created_at', 'device']);
            $table->index(['created_at', 'referer']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['created_at', 'ip_hash']);
            $table->dropIndex(['created_at', 'browser']);
            $table->dropIndex(['created_at', 'uri']);
            $table->dropIndex(['created_at', 'device']);
            $table->dropIndex(['created_at', 'referer']);
        });
    }
};
