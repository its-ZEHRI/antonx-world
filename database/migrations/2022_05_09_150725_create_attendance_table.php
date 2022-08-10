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
        Schema::create('attendance', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->string('day', 255)->nullable();;
            $table->string('month', 255)->nullable();
            $table->time('total_logged_hours')->nullable();
            $table->bigInteger('total_hours_inSec')->default(0);
            $table->date('date');
            $table->tinyInteger('attendance_status')->default(0);
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
        Schema::dropIfExists('attendance');
    }
};
