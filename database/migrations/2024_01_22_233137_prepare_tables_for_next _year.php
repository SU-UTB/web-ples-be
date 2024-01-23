<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Create a copy of the 'reservations' table
        Schema::create('r2024_rezervace', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125);
            $table->string('email', 125);
            $table->string('tel', 155);
            $table->string('note');
            $table->string('stand', 5);
            $table->string('price_all', 255);
            $table->integer('status');
            $table->dateTime('date_payment')->nullable();
            $table->timestamps();
            $table->boolean('consent');
        });

        // Copy data from 'reservations' to 'r2024_rezervace'
        DB::table('reservations')->get()->each(function ($item) {
            DB::table('r2024_rezervace')->insert(get_object_vars($item));
        });

        // Create a copy of the 'seats' table
        Schema::create('r2024_seats', function (Blueprint $table) {
            $table->id();
            $table->string('alias', 5);
            $table->string('typ', 11);
            $table->integer('rezervace')->nullable();
            $table->timestamps();
        });

        // Copy data from 'seats' to 'r2024_seats'
        DB::table('seats')->get()->each(function ($item) {
            DB::table('r2024_seats')->insert(get_object_vars($item));
        });

        // Set all 'rezervace' values in 'r2024_seats' to null
        DB::table('r2024_seats')->update(['rezervace' => null]);

        // Delete all data from 'r2024_rezervace'
        DB::table('r2024_rezervace')->delete();
    }

    public function down()
    {
        // Drop the copied tables
        Schema::dropIfExists('r2024_rezervace');
        Schema::dropIfExists('r2024_seats');
    }
};
