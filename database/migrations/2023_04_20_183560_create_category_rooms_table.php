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
        Schema::create('category_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('room');
            $table->json('slug');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('category_room_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_rooms');
    }
};
