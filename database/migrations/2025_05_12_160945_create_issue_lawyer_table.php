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
        Schema::create('issue_lawyer', function (Blueprint $table) {
            $table->foreignId('lawyer_id')->constrained()->onDelete('cascade');
            $table->foreignId('issue_id')->constrained()->onDelete('cascade');
            $table->primary(['lawyer_id', 'issue_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_lawyer');
    }
};
