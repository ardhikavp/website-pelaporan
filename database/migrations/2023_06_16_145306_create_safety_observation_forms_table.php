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
        Schema::create('safety_observation_forms', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan');
            $table->date('date_finding')->required();
            $table->foreignId('location_id')->constrained();
            $table->enum('safety_observation_type', ['unsafe_action', 'unsafe_condition', 'bad_housekeeping'])
                ->nullable();
            $table->foreignID('image_id')->constrained()->cascadeOnDelete();
            $table->text('description')->required();
            $table->text('hazard_potential')->required();
            $table->text('impact')->required();
            $table->text('short_term_recommendation')->nullable();
            $table->text('middle_term_recommendation')->nullable();
            $table->text('long_term_recommendation')->nullable();
            $table->date('completation_date')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('reviewed_by')->constrained('users');
            $table->foreignId('approved_by')->constrained('users');
            $table->enum('status',['PENDING_REVIEW','PENDING_APPROVAL', 'APPROVED', 'REJECTED']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_observation_forms');
    }
};


