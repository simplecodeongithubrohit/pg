<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->string('unit_type');
            $table->string('floor');
            $table->string('sharing_type');
            $table->decimal('daily_stay_charges_min', 8, 2);
            $table->decimal('daily_stay_charges_max', 8, 2);
            $table->boolean('is_room_available');
            $table->decimal('electricity_reading_last', 8, 2);
            $table->date('electricity_reading_date');
            $table->string('room_photos')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};
