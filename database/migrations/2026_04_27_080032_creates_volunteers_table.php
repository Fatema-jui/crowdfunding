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
        Schema::create('volunteers', function (Blueprint $table) {
        $table->id();
        $table->string('volunteer_name');
        $table->string('email');
        $table->string('phone');
        $table->string('address')->nullable();
        $table->integer('age')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->text('message')->nullable();
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
