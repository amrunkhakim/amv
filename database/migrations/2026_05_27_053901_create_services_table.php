<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('svg_icon')->nullable();
            $table->string('badge')->nullable(); // e.g. ID, N, etc.
            $table->string('link')->nullable();
            $table->boolean('is_highlighted')->default(false); // custom styling indicator (e.g. Nuansa Academy card)
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
