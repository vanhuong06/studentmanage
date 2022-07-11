<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetableTimeTableTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetable__timetable_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('timetable_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['timetable_id', 'locale']);
            $table->foreign('timetable_id')->references('id')->on('timetable__timetables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timetable__timetable_translations', function (Blueprint $table) {
            $table->dropForeign(['timetable_id']);
        });
        Schema::dropIfExists('timetable__timetable_translations');
    }
}
