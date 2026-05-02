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
        Schema::table('crises', function (Blueprint $table) {
            $table->decimal('raised_amount', 15, 2)->default(0)->after('target_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crises', function (Blueprint $table) {
            $table->dropColumn('raised_amount');
        });
    }
};
