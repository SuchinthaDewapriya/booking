<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('b_id');
            $table->integer('b_rid');
            $table->string('b_checkindate');
            $table->string('b_checkoutdate');
            $table->integer('b_rquantity');
            $table->string('b_package');
            $table->string('b_payment_method')->nullable();
            $table->integer('b_status');
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
}
