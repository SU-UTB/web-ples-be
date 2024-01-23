<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create a copy of the 'reservations' table and its data
        DB::statement('CREATE TABLE rezervace LIKE reservations');
        DB::statement('INSERT INTO rezervace SELECT * FROM reservations');

        // Create a copy of the 'seats' table and its data
        DB::statement('CREATE TABLE sedadla LIKE seats');
        DB::statement('INSERT INTO sedadla SELECT * FROM seats');

        // Set all 'rezervace' values in 'sedadla' to null
        DB::table('sedadla')->update(['rezervace' => null]);
    }

    public function down()
    {
        // Drop the copied tables
        Schema::dropIfExists('rezervace');
        Schema::dropIfExists('sedadla');
    }
};
