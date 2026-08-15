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
        Schema::create('bar_certs', function (Blueprint $table) {
            $table->id();
            $table->string('userCode');
            $table->string('code');
            $table->string('sector');
            $table->string('residentYears');
            $table->string('purposeType');
            $table->string('purpose');
            $table->string('isFirstTimeJobSeeker');
            $table->string('dayIssue');
            $table->string('monthIssue');
            $table->string('transactionCode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_certs');
    }
};