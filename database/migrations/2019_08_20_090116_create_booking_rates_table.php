<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_rates', function (Blueprint $table) {
            $table->bigIncrements('br_id');
            $table->integer('br_bookingid');
            $table->integer('br_roomRate');
            $table->integer('br_packageRate');
            $table->integer('br_bedmRate');
            $table->integer('br_totalRate');
            $table->integer('br_status');
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
        Schema::dropIfExists('booking_rates');
    }
}
