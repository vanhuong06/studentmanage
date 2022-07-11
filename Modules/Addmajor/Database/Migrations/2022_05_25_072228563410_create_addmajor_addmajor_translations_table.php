<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddmajorAddMajorTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmajor__addmajor_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('addmajor_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['addmajor_id', 'locale']);
            $table->foreign('addmajor_id')->references('id')->on('addmajor__addmajors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addmajor__addmajor_translations', function (Blueprint $table) {
            $table->dropForeign(['addmajor_id']);
        });
        Schema::dropIfExists('addmajor__addmajor_translations');
    }
}
