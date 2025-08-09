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
        Schema::create('delegation_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('session_id')->constrained('sessionsses')->onDelete('cascade');
        $table->foreignId('original_lawyer_id')->constrained('lawyers')->onDelete('cascade');
        $table->foreignId('delegate_lawyer_id')->nullable()->constrained('lawyers')->onDelete('set null');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->text('admin_note')->nullable(); 
        $table->string('delegation_file')->nullable(); // مسار ملف الإنابة
        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegation_requests');
    }
};
