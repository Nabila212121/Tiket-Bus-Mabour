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
        Schema::table('bus_tickets', function (Blueprint $table) {
            $table->dropForeign('bus_tickets_bus_schedule_id_foreign');
            $table->dropForeign('bus_tickets_bus_id_foreign');
            $table->dropForeign('bus_tickets_user_id_foreign');
            $table->foreignId('user_id')->nullable()->change();
            $table->foreignId('bus_id')->nullable()->change();
            $table->foreignId('bus_schedule_id')->nullable()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('set null');
            $table->foreign('bus_schedule_id')->references('id')->on('bus_schedules')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
