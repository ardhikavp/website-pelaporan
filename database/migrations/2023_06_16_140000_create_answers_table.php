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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan')->required();
            $table->date('date_finding')->required();
            $table->foreignId('user_id')->constrained();
            $table->string('operation_name')->required();
            $table->foreignId('company_id')->constrained();
            $table->json('answer')->required();
            $table->decimal('safety_index', 5, 2);
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->enum('status',['PENDING_REVIEW','PENDING_APPROVAL', 'APPROVED', 'REJECTED'])->default('PENDING_REVIEW');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
