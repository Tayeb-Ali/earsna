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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('bookingTime_id')->nullable();
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('service_id');
            $table->string('payment_method');
            $table->string('paid')->nullable();
            $table->string('remaining');
            $table->integer('total');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
