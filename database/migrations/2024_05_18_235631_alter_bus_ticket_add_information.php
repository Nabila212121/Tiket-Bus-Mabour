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
            $table->string('customer_name')->nullable();
        });
        Schema::table('bus_schedules', function (Blueprint $table) {
            $table->dropColumn('arrival_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bus_tickets', function (Blueprint $table) {
            $table->dropColumn('customer_name');
        });
        Schema::table('bus_schedules', function (Blueprint $table) {
            $table->time('arrival_time')->nullable();
        });
    }
};
