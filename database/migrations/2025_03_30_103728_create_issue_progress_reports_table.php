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
        Schema::create('issue_progress_reports', function (Blueprint $table) {
            $table->id();
            $table->text('report');
            $table->integer('pre_session_count');
            $table->foreignId('session_id')->constrained('sessionsses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_progress_reports');
    }
};
