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
        Schema::create('add_cafe_item_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->length(11);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('brand_name');
            $table->integer('size')->length(11)->default(0);
            $table->integer('price')->length(11)->default(0);
            $table->string('item_image');
            $table->string('remarks')->nullable();
            $table->string('request_status')->default('pending');
            $table->unsignedInteger('remark_by')->length(11)->nullable();
            $table->foreign('remark_by')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('add_cafe_item_requests');
    }
};
