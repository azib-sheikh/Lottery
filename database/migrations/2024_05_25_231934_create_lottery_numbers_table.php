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
        Schema::create('lottery_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lottery_master_id');
            $table->foreign('lottery_master_id')->references('id')->on('lottery_master');
            $table->unsignedBigInteger('lottery_id');
            $table->foreign('lottery_id')->references('id')->on('lotteries');
            $table->integer('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_numbers');
    }
};
