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
            $table->smallInteger('tempGhouse')->default(0);
            $table->smallInteger('UrGHouse')->default(0);
            $table->smallInteger('moduleTemp')->default(0);
            $table->smallInteger('lum')->default(0);
           $table->smallInteger('sen1')->default(0);
            $table->smallInteger('sen2')->default(0);
            $table->smallInteger('sen3')->default(0);
            $table->smallInteger('tempExternal')->default(0);
            $table->smallInteger('UrExternal')->default(0);
        $table->smallInteger('maxTemp')->default(0);
        $table->smallInteger('minTemp')->default(0);
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
