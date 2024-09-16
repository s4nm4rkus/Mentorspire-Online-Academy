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
        Schema::create('activity_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('activity_number', 2);
            $table->string('activity_title');
            $table->string('activity_description', 1000);
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('course_tbl')->onDelete('cascade');
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
        Schema::dropIfExists('activity_tbl');
    }
};
