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
        Schema::create('activityfilesdoc_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('activity_doc')->nullable();
            $table->string('activity_doc_name')->nullable();
            $table->unsignedBigInteger('activity_id');
            $table->foreign('activity_id')->references('id')->on('activity_tbl')->onDelete('cascade');
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
        Schema::dropIfExists('activityfilesdoc_tbl');
    }
};
