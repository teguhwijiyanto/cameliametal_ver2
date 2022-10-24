<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workorder_id');
            $table->bigInteger('bundle_num');
            $table->string('dies_num');
            // $table->string('area');
            $table->bigInteger('diameter_ujung');
            $table->bigInteger('diameter_tengah');
            $table->bigInteger('diameter_ekor');
            $table->bigInteger('kelurusan_aktual');
            $table->bigInteger('panjang_aktual');
            $table->bigInteger('berat_fg');
            $table->bigInteger('pcs_per_bundle');
            $table->boolean('bundle_judgement');
            $table->boolean('visual');
            $table->timestamps();

            $table->foreign('workorder_id')->references('id')->on('workorders')
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
        Schema::dropIfExists('productions');
    }
}
