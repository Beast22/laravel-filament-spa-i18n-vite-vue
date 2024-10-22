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
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('title');
            $table->json('descr');
            $table->json('city');
            $table->json('beds');
            $table->json('bath');
            $table->json('floor');
            $table->json('square');
            $table->json('price');
            $table->json('video');
            $table->boolean('is_published')->default(false);
            $table->boolean('sold')->default(false);
            $table->boolean('latest')->default(false);
            $table->unsignedBigInteger('category_city_id');
            $table->unsignedBigInteger('category_room_id');
            $table->unsignedBigInteger('category_price_id');
            
            $table
                ->foreign('category_city_id')
                ->references('id')
                ->on('category_cities')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('category_room_id')
                ->references('id')
                ->on('category_rooms')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('category_price_id')
                ->references('id')
                ->on('category_prices')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

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
        Schema::dropIfExists('goods');
    }
};
