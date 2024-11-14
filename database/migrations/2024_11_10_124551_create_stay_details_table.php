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
        Schema::create('stay_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->date('stay_start_date');
            $table->date('stay_end_date')->nullable();
            $table->date('move_in_date')->nullable();
            $table->date('move_out_date')->nullable();
            $table->integer('lock_in_period')->nullable();
            $table->integer('notice_period')->nullable();
            $table->integer('agreement_period')->nullable();
            $table->string('rental_frequency')->nullable();
            $table->date('add_rent_on')->nullable();
            $table->integer('fixed_rent')->nullable();
            $table->integer('regular_security_deposit')->nullable();
            $table->string('remark')->nullable();
            // ... Add other columns here
            $table->text('electricity_meter_details')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('stay_details');
    }
};
