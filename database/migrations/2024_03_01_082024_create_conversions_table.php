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
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedBigInteger('rate');
            $table->string('to_currency');
            $table->unsignedBigInteger('to_amount');
            $table->unsignedBigInteger('received_amount');
            $table->unsignedBigInteger('exchange_fee');
            $table->integer('processing_time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
