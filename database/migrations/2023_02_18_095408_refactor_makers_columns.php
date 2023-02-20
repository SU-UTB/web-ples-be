<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::rename('salons', 'makers');
        Schema::rename('salon_reservations', 'maker_reservations');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::rename('makers', 'salons');
        Schema::rename('maker_reservations', 'salon_reservations');
    }
};
