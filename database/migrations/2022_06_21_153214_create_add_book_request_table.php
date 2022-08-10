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
        Schema::create('add_book_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->length(11);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('book_title');
            $table->string('author');
            $table->string('description')->nullable();
            $table->string('category')->nullable();
            $table->string('book_link')->nullable();
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
        Schema::dropIfExists('add_book_requests');
    }
};
