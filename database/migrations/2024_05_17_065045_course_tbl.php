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
        Schema::create('course_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('course_poster');
            $table->string('course_title');
            $table->string('course_code')->unique();
            $table->string('course_description', 5000);
            $table->integer('progress_activity')->default(0);
            // $table->unsignedBigInteger('activity_id');
            // $table->foreign('activity_id')->references('id')->on('activity_tbl')->onDelete('cascade');
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
        Schema::dropIfExists('course_tbl');
    }
};
