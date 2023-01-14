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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 25);
            $table->string('content');
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('reservation_from');
            $table->integer('contact_user_id');
        });


        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('role');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('contacts');
    }
};
