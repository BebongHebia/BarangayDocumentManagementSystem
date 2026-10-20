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
        Schema::create('cedulas', function (Blueprint $table) {
            $table->id();
            $table->string('resType');
            $table->string('userCode');
            $table->string('cedulaNo');
            $table->string('dateAcquired');
            $table->string('validity');
            $table->string('completeName');
            $table->string('address');
            $table->string('placeOfBirth');
            $table->string('dateOfBirth');
            $table->string('civilStatus');
            $table->string('height');
            $table->string('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cedulas');
    }
};
