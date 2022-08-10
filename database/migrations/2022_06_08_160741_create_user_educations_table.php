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
        Schema::create('user_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->length(11);
            $table->foreign('user_id')->length(11)->references('id')->on('users')->onDelete('cascade');
            $table->string('degree', 255);
            $table->string('institute', 255);
            $table->date('startDate');
            $table->date('endDate')->nullable();
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
        Schema::dropIfExists('user_educations');
    }
};
