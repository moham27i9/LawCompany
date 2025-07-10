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
       Schema::create('consultation_requests', function (Blueprint $table) {
    $table->id();
    $table->text('subject');
    $table->text('details')->nullable();
    $table->boolean('is_locked')->default(false);
    $table->enum('status', ['pending', 'approved', 'rejected','closed'])->default('pending');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
