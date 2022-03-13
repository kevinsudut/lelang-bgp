<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_bid_snapshots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_bid_history_id');
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('amount');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_bid_history_id')->references('id')->on('product_bid_histories')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_bid_snapshots');
    }
};
