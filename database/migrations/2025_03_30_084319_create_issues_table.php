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
            $table->string('category');                   
            $table->string('opponent_name')->nullable();   
            $table->string('court_name');
            $table->integer('number_of_payments')->default(0); 
            $table->decimal('total_cost', 12, 2)->nullable();  
            $table->integer('lawyer_percentage')->default(0);
            $table->decimal('amount_paid', 12, 2)->default(0); 
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->enum('status', ['open', 'in_progress', 'closed', 'archived'])->default('open');
            $table->enum('priority', ['normal', 'medium', 'high', 'critical'])->default('normal');
            $table->timestamp('start_date')->nullable();   
            $table->timestamp('end_date')->nullable();     
        
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
