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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['financial', 'legal', 'hr', 'other'])->default('financial');
            $table->string('file_path');
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade'); 
            $table->date('report_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
