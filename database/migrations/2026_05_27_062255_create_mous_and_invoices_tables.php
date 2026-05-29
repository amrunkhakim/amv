<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mous', function (Blueprint $table) {
            $table->id();
            $table->string('mou_number')->unique();
            $table->string('company_name');
            $table->string('client_name');
            $table->string('title');
            $table->text('content');
            $table->longText('signature_data')->nullable(); // Stores base64 png
            $table->timestamp('signature_date')->nullable();
            $table->boolean('is_signed')->default(false);
            $table->string('verification_token')->unique();
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('client_name');
            $table->string('client_email');
            $table->decimal('amount', 15, 2);
            $table->date('issued_date');
            $table->date('due_date');
            $table->string('status')->default('pending'); // pending, paid, cancelled
            $table->json('items'); // JSON array of item details
            $table->string('verification_token')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mous');
        Schema::dropIfExists('invoices');
    }
};
