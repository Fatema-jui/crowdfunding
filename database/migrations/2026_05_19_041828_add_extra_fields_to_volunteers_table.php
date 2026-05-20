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
        Schema::table('volunteers', function (Blueprint $table) {
            $table->string('password')->after('email');
            $table->string('NID')->nullable()->after('address');
            $table->date('birth_date')->nullable()->after('nid');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('NID');
            $table->dropColumn('birth_date');
            
        });
    }
};
