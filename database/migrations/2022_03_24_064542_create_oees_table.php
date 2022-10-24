<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workorder_id');
            $table->bigInteger('dt_briefing');
            $table->bigInteger('dt_cek_shot_blast');
            $table->bigInteger('dt_cek_mesin');
            $table->bigInteger('dt_sambung_bahan');
            $table->bigInteger('dt_bongkar_pasang_dies');
            $table->bigInteger('dt_setting_awal');
            $table->bigInteger('dt_selesai_satu_bundle');
            $table->bigInteger('dt_cleaning_area_mesin');
            $table->bigInteger('dt_tunggu_bahan_baku');
            $table->bigInteger('dt_ganti_bahan_baku');
            $table->bigInteger('dt_tunggu_dies');
            $table->bigInteger('dt_gosok_dies');
            $table->bigInteger('dt_ganti_part_shot_blast');
            $table->bigInteger('dt_putus_dies');
            $table->bigInteger('dt_setting_ulang_kelurusan');
            $table->bigInteger('dt_ganti_polishing_dies');
            $table->bigInteger('dt_ganti_nozle_polishing_mesin');
            $table->bigInteger('dt_ganti_roller_straightener');
            $table->bigInteger('dt_dies_rusak');
            $table->bigInteger('dt_mesin_trouble_operator');
            $table->bigInteger('dt_validasi_qc');
            $table->bigInteger('dt_mesin_trouble_maintenance');
            $table->bigInteger('dt_istirahat');
            $table->bigInteger('total_runtime');
            $table->bigInteger('total_downtime');
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
        Schema::dropIfExists('oees');
    }
}
