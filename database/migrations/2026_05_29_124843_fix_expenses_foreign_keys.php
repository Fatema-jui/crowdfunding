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
         Schema::table('expenses', function (Blueprint $table) {
        $table->dropForeign(['crisis_id']);
        $table->dropForeign(['volunteer_id']);

        $table->foreign('crisis_id')
              ->references('id')->on('crises')
              ->onDelete('cascade');

        $table->foreign('volunteer_id')
              ->references('id')->on('volunteers')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
        $table->dropForeign(['crisis_id']);
        $table->dropForeign(['volunteer_id']);
    });
    
    }
};
