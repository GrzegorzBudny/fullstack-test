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
        Schema::table('receipt_registrations', function (Blueprint $table) {
            $table->enum('prize_type', ['nagroda główna', 'nagroda dodatkowa', 'nagroda pocieszenia'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receipt_registrations', function (Blueprint $table) {
            $table->dropColumn(['prize_type']);
        });
    }
};
