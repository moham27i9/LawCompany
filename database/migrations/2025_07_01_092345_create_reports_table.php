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
            $table->enum('type', ['financial', 'legal', 'hr', 'other'])->default('financial'); // نوع التقرير
            $table->string('file_path'); // مسار الـ PDF
            $table->decimal('total_amount', 12, 2)->default(0); // مجموع المبلغ
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade'); // الموظف الذي أنشأ التقرير
            $table->date('report_date'); // تاريخ التقرير
            $table->text('notes')->nullable(); // ملاحظات اختيارية
            $table->timestamps(); // created_at, updated_at
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
