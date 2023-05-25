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
        Schema::create('parking_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_id')->constrained();
            $table->enum('event_type', ['start', 'stop']);
            $table->timestamp('event_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_events');
    }
};
