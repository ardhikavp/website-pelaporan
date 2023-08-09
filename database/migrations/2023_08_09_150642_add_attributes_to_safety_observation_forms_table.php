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
        Schema::table('safety_observation_forms', function (Blueprint $table) {
            $table->string('finish_report_path')->nullable()->default(null);
            $table->enum('finish_report',['OPEN','CLOSED'])->default('OPEN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('safety_observation_forms', function (Blueprint $table) {
            $table->dropColumn('finish_report_path');
            $table->dropColumn('finish_report');
        });
    }
};
