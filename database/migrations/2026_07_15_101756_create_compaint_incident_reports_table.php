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
        Schema::create('compaint_incident_reports', function (Blueprint $table) {
            $table->id();
            $table->string('userCode');
            $table->string('complainType');
            $table->string('description');
            $table->string('respondent');
            $table->string('status');
            $table->string('smsStatus');
            $table->string('smsMessage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compaint_incident_reports');
    }
};