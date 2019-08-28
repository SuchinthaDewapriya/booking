<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->bigIncrements('cd_id');
            $table->integer('cd_bookingid');
            $table->string('cd_salutation');
            $table->string('cd_first_name');
            $table->string('cd_last_name');
            $table->string('cd_email');
            $table->string('cd_phone');
            $table->string('cd_country');
            $table->string('cd_note');
            $table->string('cd_status');
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
        Schema::dropIfExists('customer_details');
    }
}
