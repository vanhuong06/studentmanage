<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageManageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage__manage_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('manage_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['manage_id', 'locale']);
            $table->foreign('manage_id')->references('id')->on('manage__manages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manage__manage_translations', function (Blueprint $table) {
            $table->dropForeign(['manage_id']);
        });
        Schema::dropIfExists('manage__manage_translations');
    }
}
