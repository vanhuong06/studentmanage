<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementManagementTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management__management_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('management_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['management_id', 'locale']);
            $table->foreign('management_id')->references('id')->on('management__management')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('management__management_translations', function (Blueprint $table) {
            $table->dropForeign(['management_id']);
        });
        Schema::dropIfExists('management__management_translations');
    }
}
