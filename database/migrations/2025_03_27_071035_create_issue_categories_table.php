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
    Schema::create('issue_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // اسم التصنيف
        $table->foreignId('parent_id')->nullable()->constrained('issue_categories')->onDelete('cascade'); // التصنيف الأب
        $table->enum('type', ['عام', 'قضائي', 'وكالات'])->nullable(); // نوع التصنيف الأعلى، إن وجد
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_categories');
    }
};
