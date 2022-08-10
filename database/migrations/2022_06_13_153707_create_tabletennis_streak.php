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
        Schema::create('tabletennis_streak', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('streak')->length(11)->unsigned();

            $table->unsignedInteger('user_1_id')->length(11);
            $table->unsignedInteger('user_2_id')->length(11);

            $table->foreign('user_1_id')->length(11)->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_2_id')->length(11)->unsigned()->references('id')->on('users')->onDelete('cascade');

            $table->integer('user_1_wins')->length(11)->unsigned();
            $table->integer('user_2_wins')->length(11)->unsigned();
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
        Schema::dropIfExists('tabletennis_streak');
    }
};
