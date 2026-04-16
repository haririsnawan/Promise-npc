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
        Schema::table('npc_part_processes', function (Blueprint $table) {
            $table->integer('actual_qty')->nullable()->after('actual_completion_date');
            $table->string('photo_proof')->nullable()->after('actual_qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('npc_part_processes', function (Blueprint $table) {
            $table->dropColumn(['actual_qty', 'photo_proof']);
        });
    }
};
