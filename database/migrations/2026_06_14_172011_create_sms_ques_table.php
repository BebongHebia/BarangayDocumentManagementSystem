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
        Schema::create('sms_ques', function (Blueprint $table) {
            $table->id();
            $table->string("userCode");
            $table->string("name");
            $table->string("phone");
            $table->string("transactionCode");
            $table->string("docType");
            $table->string("smsStatus");
            $table->string("code");
            $table->string("actType");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_ques');
    }
};