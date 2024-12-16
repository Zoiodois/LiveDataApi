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
            $table->tinyInteger('tempGhouse')->default(0);
            $table->tinyInteger('UrGHouse')->default(0);
            $table->tinyInteger('lum')->default(0);
           $table->tinyInteger('sen1')->default(0);
            $table->tinyInteger('sen2')->default(0);
            $table->tinyInteger('sen3')->default(0);
            $table->tinyInteger('tempExternal')->default(0);
            $table->tinyInteger('UrExternal')->default(0);
        $table->tinyInteger('maxTemp')->default(0);
        $table->tinyInteger('minTemp')->default(0);
        $table->string('queue')->default('fail');
        $table->Integer('lastCycleEpoch')->default(0);
        $table->Integer('lastIr1Epoch')->default(0);
        $table->Integer('lastIr2Epoch')->default(0);
        $table->Integer('lastIr3Epoch')->default(0);
        $table->Integer('lastIr4Epoch')->default(0);
        $table->Integer('lastIr5Epoch')->default(0);
        $table->Integer('lastCycleStart')->default(0);
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
