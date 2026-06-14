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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string("userCode");
            $table->string("tranCode");
            $table->integer("cedulaNo");
            $table->string("cedIssOn");
            $table->string("cedIssAt");
            $table->double("cedAmount");
            $table->integer("orNo");
            $table->string("orIssOn");
            $table->string("orIssAt");
            $table->double("orAmount");
            $table->double("docAmount");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};