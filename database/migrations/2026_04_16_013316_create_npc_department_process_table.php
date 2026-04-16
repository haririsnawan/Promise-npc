<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('npc_department_process', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('process_id');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('npc_departments')->onDelete('cascade');
            $table->foreign('process_id')->references('id')->on('npc_processes')->onDelete('cascade');
        });

        // Migrate existing data
        $processes = DB::table('npc_processes')->whereNotNull('department_id')->get();
        foreach ($processes as $process) {
            DB::table('npc_department_process')->insert([
                'department_id' => $process->department_id,
                'process_id' => $process->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('npc_processes', function (Blueprint $table) {
            $table->dropColumn('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('npc_processes', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('process_name');
        });

        // Revert data backwards (first department assigned)
        $pivots = DB::table('npc_department_process')->get();
        foreach ($pivots as $pivot) {
            DB::table('npc_processes')->where('id', $pivot->process_id)->update([
                'department_id' => $pivot->department_id,
            ]);
        }

        Schema::dropIfExists('npc_department_process');
    }
};
