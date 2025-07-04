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
Schema::create('interviews', function (Blueprint $table) {
    $table->id();
    $table->dateTime('date');
    $table->enum('result', ['passed', 'failed', 'pending'])->default('pending');
    $table->text('note')->nullable();
    $table->foreignId('jobApp_id')->constrained('job_applications')->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
