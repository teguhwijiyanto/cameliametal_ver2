<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDowntimeRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downtime_remarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('downtime_id');
            $table->boolean('is_waste_downtime');
            $table->string('downtime_reason');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('downtime_id')->references('id')->on('downtimes')
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
        Schema::dropIfExists('downtime_remarks');
    }
}
