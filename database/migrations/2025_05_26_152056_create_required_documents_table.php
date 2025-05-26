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
       Schema::create('required_documents', function (Blueprint $table) {
    $table->id();
    $table->foreignId('issue_id')->constrained('issues')->onDelete('cascade');
    $table->string('require_file_type'); // مثل: هوية، شهادة...
    $table->string('file')->nullable(); // يرفعها العميل
    $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
    $table->text('note')->nullable(); // ملاحظة في حال الرفض
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('required_documents');
    }
};
