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
        Schema::table('npc_master_routings', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('process_id');
        });

        Schema::table('npc_part_processes', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('process_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('npc_part_processes', function (Blueprint $table) {
            $table->dropColumn('department_id');
        });

        Schema::table('npc_master_routings', function (Blueprint $table) {
            $table->dropColumn('department_id');
        });
    }
};
