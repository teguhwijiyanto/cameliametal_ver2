<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('shift_id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();

            $table->foreign('machine_id')->references('id')->on('machines')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('shift_id')->references('id')->on('shifts')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
