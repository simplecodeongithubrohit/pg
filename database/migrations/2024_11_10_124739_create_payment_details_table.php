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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            //$table->integer('tenant_id')->default(1)->change();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->date('payment_date');
            $table->decimal('amount_paid', 8, 2);
            $table->decimal('due_amount', 8, 2)->nullable();
            $table->date('due_date')->nullable();
            //$table->date('due_end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('payment_details');
    }
};
