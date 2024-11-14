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
        if (!Schema::hasColumn('rooms', 'floor_id')) {

            Schema::table('rooms', function (Blueprint $table) {
                //

                $table->unsignedBigInteger('floor_id')->nullable(); // Add nullable if required
                $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            //
            $table->dropForeign(['floor_id']);
            $table->dropColumn('floor_id');
        });
    }
};
