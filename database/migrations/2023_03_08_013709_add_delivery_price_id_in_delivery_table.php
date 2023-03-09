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
        Schema::table('delivery', function (Blueprint $table) {
            $table->biginteger('delivery_price_id')->unsigned();
            $table->foreign('delivery_price_id')->references('id')->on('delivery_price')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery', function (Blueprint $table) {
            $table->dropForeign(['delivery_price_id']);
            $table->dropColumn('delivery_price_id');
        });
    }
};
