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
     Schema::create('expenses', function (Blueprint $table) {
    $table->id();
    $table->string('description'); // وصف المصروف
    $table->decimal('amount', 12, 2);
    $table->enum('type', ['case', 'payroll', 'operational', 'other']); 
    $table->unsignedBigInteger('related_id')->nullable(); // ID من الجدول المرتبط (مثلاً القضية أو الراتب)
    $table->string('related_type')->nullable(); // نوع العلاقة (Issue, Payroll...)
    $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
