<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *///governorate, price, time 
    public function up(): void
    {
        Schema::create('delivery_price', function (Blueprint $table) {
            $table->id();
            $table->string('governorate');
            $table->double('price', 15, 2);
            $table->integer('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_price');
    }
};
