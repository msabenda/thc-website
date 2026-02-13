<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone')->unique();                    // +1 format
            $table->string('email')->unique();
            $table->enum('fee_paid', ['yes', 'no']);
            $table->string('receipt_path')->nullable();           // e.g. applications/2026/abc123.jpg
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('membership_id')->nullable()->unique();
            $table->text('rejection_reason')->nullable();
            $table->string('application_ref')->unique();          // APP-ABC123 for user reference
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};