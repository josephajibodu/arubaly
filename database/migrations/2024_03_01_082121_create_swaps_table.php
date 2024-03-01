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
        Schema::create('swaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('merchant_id')->constrained()->nullOnDelete()->cascadeOnUpdate();
            // $table->string('from_currency');
            // $table->unsignedBigInteger('from_amount');
            // $table->string('to_currency');
            // $table->unsignedBigInteger('to_amount');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swaps');
    }
};