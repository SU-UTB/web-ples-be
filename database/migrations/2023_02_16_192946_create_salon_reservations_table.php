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
        Schema::create('salon_reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('salon');
            $table->string('time');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->integer('service');
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
        Schema::dropIfExists('salon_reservations');
    }
};
