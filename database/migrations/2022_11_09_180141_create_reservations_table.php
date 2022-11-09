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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name',125);
            $table->string('email',125);
            $table->string('tel',155);
            $table->string('note');
            $table->string('stand',5);
            $table->string('price_all',255);
            $table->integer('status');
            $table->dateTime('date_reservation');
            $table->dateTime('date_payment');
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
        Schema::dropIfExists('reservations');
    }
};
