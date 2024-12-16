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
        Schema::create('livedatas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('tempGhouse');
            $table->tinyInteger('UrGHouse');
            $table->tinyInteger('lum');
           $table->tinyInteger('sen1');
            $table->tinyInteger('sen2');
            $table->tinyInteger('sen3');
            $table->tinyInteger('tempExternal');
            $table->tinyInteger('UrExternal');
        $table->tinyInteger('maxTemp');
        $table->tinyInteger('minTemp');
        $table->string('queue');
        $table->Integer('lastCycleEpoch');
        $table->Integer('lastIr1Epoch');
        $table->Integer('lastIr2Epoch');
        $table->Integer('lastIr3Epoch');
        $table->Integer('lastIr4Epoch');
        $table->Integer('lastIr5Epoch');
        $table->string('lastCycleStart');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livedatas');
    }
};
