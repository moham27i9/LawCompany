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
        Schema::create('salary_adjustments', function (Blueprint $table) {
        $table->id();
        $table->morphs('employable'); // employable_id + employable_type
        $table->enum('type', ['allowance', 'deduction']);
        $table->string('reason')->nullable();
        $table->decimal('amount', 12, 2);
        $table->boolean('processed')->default(false);
        $table->date('effective_date');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_adjustments');
    }
};
