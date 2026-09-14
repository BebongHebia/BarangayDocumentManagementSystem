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
            $table->string('middleName');
            $table->string('lastName');
            $table->string('suffix');
            $table->string('birthdate');
            $table->string('placeOfBirth');
            $table->string('sex');
            $table->string('bloodType');
            $table->string('civilStatus');
            $table->string('religion');
            $table->string('address');
            $table->string('citizenship');
            $table->string('profession');
            $table->string('contact');
            $table->string('email');
            $table->string('educationalAtt');
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