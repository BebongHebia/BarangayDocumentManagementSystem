<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_activities', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('activity');
            $table->longText('description');
            $table->date('dateStart');
            $table->date('dateEnd');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_activities');
    }
};