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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->float('payment');
            // $table->integer('confirm');
            $table->decimal('allowances', 12, 2)->default(0); // إجمالي البدلات
            $table->decimal('deductions', 12, 2)->default(0); // إجمالي الخصومات
            $table->enum('status', ['pending', 'approved', 'paid', 'rejected', 'on_hold'])->default('pending');
            $table->unsignedBigInteger('payable_id');
            $table->string('payable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
