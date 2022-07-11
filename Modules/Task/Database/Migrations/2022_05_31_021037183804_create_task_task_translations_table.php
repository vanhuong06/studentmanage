<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTaskTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task__task_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('task_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['task_id', 'locale']);
            $table->foreign('task_id')->references('id')->on('task__tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task__task_translations', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
        });
        Schema::dropIfExists('task__task_translations');
    }
}
