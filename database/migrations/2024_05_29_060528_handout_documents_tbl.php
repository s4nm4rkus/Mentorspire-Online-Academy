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
        Schema::create('handout_documents_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('handout_file_title')->nullable();
            $table->string('handout_file_name');
            $table->string('handout_doc');
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

    Schema::dropIfExists('handout_documents_tbl'); 
}
};
