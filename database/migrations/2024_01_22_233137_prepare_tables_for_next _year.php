<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop the 'reservations' table if it exists before creating a new one
        Schema::dropIfExists('reservations');
        
        // Create a copy of the 'r2023_rezervace' table and its data
        DB::statement('CREATE TABLE reservations LIKE r2023_rezervace');
        DB::statement('INSERT INTO reservations SELECT * FROM r2023_rezervace');

        // Drop the 'seats' table if it exists before creating a new one
        Schema::dropIfExists('seats');
        
        // Create a copy of the 'r2023_seats' table and its data
        DB::statement('CREATE TABLE seats LIKE r2023_seats');
        DB::statement('INSERT INTO seats SELECT * FROM r2023_seats');

        // Set all 'rezervace' values in 'seats' to null
        DB::table('seats')->update(['rezervace' => null]);
    }

    public function down()
    {
        // Drop the new 'reservations' and 'seats' tables if they exist
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('seats');
    }
};
