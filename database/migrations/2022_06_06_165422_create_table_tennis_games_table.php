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
        Schema::create('table_tennis_games', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_1_id')->length('11');
            $table->unsignedInteger('user_2_id')->length('11');

            // $table->foreignId('user_1_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_1_id')->length('11')->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_1_score')->length('11')->unsigned();

            $table->foreign('user_2_id')->length('11')->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_2_score')->length('11')->unsigned();

            $table->integer('win_margin')->length('11')->unsigned();

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
        Schema::dropIfExists('table_tennis_scores');
    }
};
