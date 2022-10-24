<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->time('start_time'); 
            $table->time('end_time');
            $table->time('break_1_start')->nullable();  
            $table->time('break_1_end')->nullable();
            $table->time('break_2_start')->nullable();
            $table->time('break_2_end')->nullable();
            $table->time('break_3_start')->nullable();
            $table->time('break_3_end')->nullable();
            $table->time('break_4_start')->nullable();
            $table->time('break_4_end')->nullable();
            $table->time('break_5_start')->nullable();
            $table->time('break_5_end')->nullable();
            $table->string('background_color');
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
        Schema::dropIfExists('shifts');
    }
}
