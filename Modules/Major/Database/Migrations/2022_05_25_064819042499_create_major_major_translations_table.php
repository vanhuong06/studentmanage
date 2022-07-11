<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorMajorTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('major__major_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('major_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['major_id', 'locale']);
            $table->foreign('major_id')->references('id')->on('major__majors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('major__major_translations', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
        });
        Schema::dropIfExists('major__major_translations');
    }
}
