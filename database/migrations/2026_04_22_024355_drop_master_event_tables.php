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
        Schema::table('npc_events', function (Blueprint $table) {
            $table->dropColumn('master_event_id');
        });

        Schema::dropIfExists('npc_master_events');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('npc_master_events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('model_id');
            $table->timestamps();
        });

        Schema::table('npc_events', function (Blueprint $table) {
            $table->unsignedBigInteger('master_event_id')->after('id')->nullable();
        });
    }
};
