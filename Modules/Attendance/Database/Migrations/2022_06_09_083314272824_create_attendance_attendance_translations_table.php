<?php

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceAttendanceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance__attendance_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('attendance_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['attendance_id', 'locale']);
            $table->foreign('attendance_id')->references('id')->on('attendance__attendances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance__attendance_translations', function (Blueprint $table) {
            $table->dropForeign(['attendance_id']);
        });
        Schema::dropIfExists('attendance__attendance_translations');
    }
}
