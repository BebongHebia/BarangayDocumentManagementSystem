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
        Schema::create('staff_officials', function (Blueprint $table) {
            $table->id();
            $table->string("completeName");
            $table->string("sex");
            $table->string("bday");
            $table->string("birthPlace");
            $table->string("civilStatus");
            $table->string("position");
            $table->string("status");
            $table->string("code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_officials');
    }
};
