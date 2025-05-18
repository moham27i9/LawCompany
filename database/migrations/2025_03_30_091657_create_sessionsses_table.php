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
        Schema::create('sessionsses', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['preliminary', 'hearing', 'judgment', 'pleading', 'postponed', 'mediation', 'followup', 'consultation']);
            $table->enum('outcome', [ 'held', 'postponed', 'canceled', 'rescheduled', 'closed', 'judged', 'attended_by_lawyer_only', 'attended_by_client_only', 'absent' ]);
            $table->boolean('is_attend')->default(false);
            $table->foreignId('issue_id')->constrained('issues')->onDelete('cascade');
            $table->foreignId('lawyer_id')->constrained('lawyers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessionsses');
    }
};
