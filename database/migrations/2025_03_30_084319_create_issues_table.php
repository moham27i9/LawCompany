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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');                      
            $table->string('issue_number')->unique();      
            $table->string('category');                    // تصنيف مثل "مدنية" - "جنائية" - "تجارية"
            $table->string('opponent_name')->nullable();   //اسم الخصم
            $table->string('court_name');                    
            $table->integer('number_of_payments')->default(0); // عدد الدفعات المدفوعة
            $table->decimal('total_cost', 12, 2)->nullable();  // التكلفة الإجمالية
            $table->decimal('amount_paid', 12, 2)->default(0); // المبلغ المدفوع حتى الآن
            $table->text('description')->nullable();       
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // صاحب القضية (العميل)
            $table->enum('status', ['open', 'in_progress', 'closed', 'archived'])->default('open');
            $table->enum('priority', ['normal', 'medium', 'high', 'critical'])->default('normal');
            $table->timestamp('start_date')->nullable();    // تاريخ بدء القضية
            $table->timestamp('end_date')->nullable();      // تاريخ إنهاء القضية (عند الإغلاق)
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
