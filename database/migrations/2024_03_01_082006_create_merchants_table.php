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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('reference');

            $table->string('rate');
            $table->string('awg_balance');
            $table->string('min_amount');
            $table->string('max_amount');
            $table->string('payment_type');

            // for receiving payments
            $table->string('bankname');
            $table->string('accountname');
            $table->string('accountnumber');

            $table->string('terms');

            $table->string('status');
            $table->string('availability');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};