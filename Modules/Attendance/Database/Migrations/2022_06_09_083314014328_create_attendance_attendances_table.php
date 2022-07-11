<?php

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance__attendances', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            $table->integer('emp_id')->unsigned();

                $table->dateTime('attendance_time');
            $table->dateTime('leave_time')->nullable();
            $table->timestamps();
        });
        Schema::table('attendance__attendances', function(Blueprint $table) {
            $table->foreign('emp_id')->references('id')->on('management__management');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['emp_id']);
        });
        Schema::dropIfExists('attendance__attendances');
    }
}
