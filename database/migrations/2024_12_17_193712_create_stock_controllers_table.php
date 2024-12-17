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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('batchId')->unique();
            $table->integer('matrixId');
            $table->integer('seedBankId');
            $table->string('idColor')->nullable();
            $table->integer('quantity');
            $table->date('plantDate');
            $table->date('endPrevision');
            $table->string('status');
            $table->integer('quantitySold')->nullable();
            $table->integer('quantityDead')->nullable();
            $table->tinyText('observation')->nullable();;
            $table->tinyText('displayName');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
