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
        Schema::create('cafe_items', function (Blueprint $table) {
            $table->increments('id');

            $table->foreignId('brand_id')->length(11);
            $table->string('item_name', 255);
            $table->string('size');
            $table->integer('price')->length(11)->default(0);
            $table->integer('stock')->length(11)->default(0);
            $table->string('item_image', 255);
            $table->foreignId('created_by')->length(11)->nullable();
            $table->foreignId('updated_by')->length(11)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cafe_items');
    }
};
