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
        Schema::create('user_chosen_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lottery_id');
            $table->unsignedBigInteger('lottery_master_id');
            $table->integer('number');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('lottery_id')->references('id')->on('lotteries');
            $table->foreign('lottery_master_id')->references('id')->on('lottery_master');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_chosen_numbers');
    }
};
