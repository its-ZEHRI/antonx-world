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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('atn_number')->unique();
            $table->string('email')->unique();
            $table->string('contact', 255)->nullable();
            $table->date('joining_date');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('image_url', 255)->nullable();
            $table->text('current_address', 255)->nullable();
            $table->text('postal_address')->nullable();
            $table->string('blood_group', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('color', 255)->nullable();
            $table->string('job_type', 255)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->foreignId('role_id')->nullable();
            $table->foreignId('designation_id');
            $table->bigInteger('salary')->default(0);
            $table->integer('cafe_bill')->length(11)->default(0);
            $table->boolean('isCheckin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
