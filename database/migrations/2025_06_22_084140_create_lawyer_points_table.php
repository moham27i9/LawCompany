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
Schema::create('lawyer_points', function (Blueprint $table) {
    $table->id();
    $table->foreignId('lawyer_id')->constrained('lawyers')->onDelete('cascade');
    $table->integer('points')->default(0);
    $table->string('source'); // مثلاً: attendance, session_type, admin
    $table->text('notes')->nullable();
    $table->foreignId('session_id')->nullable()->constrained('sessionsses')->onDelete('set null');
    $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null'); // للمكافآت اليدوية
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyer_points');
    }
};
