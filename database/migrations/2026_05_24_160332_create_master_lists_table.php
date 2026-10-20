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
        Schema::create('master_lists', function (Blueprint $table) {
            $table->id();
            $table->string('listCode');
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->string('suffix')->nullable();
            $table->string('birthdate');
            $table->string('placeOfBirth');
            $table->string('sex');
            $table->string('bloodType');
            $table->string('civilStatus');
            $table->string('religion')->nullable();
            $table->string('purok')->nullable();
            $table->string('address');
            $table->string('citizenship');
            $table->string('profession')->nullable();
            $table->string('socialStatus')->nullable();
            $table->string('isIP')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('educationalAtt')->nullable();
            $table->string('resType');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_lists');
    }
};