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
        Schema::create('session_appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('type')->nullable(); // مثلاً: follow_up, judgment
            $table->foreignId('session_id')->constrained('sessionss')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_appointments');
    }
};
