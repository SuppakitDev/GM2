<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDDCTempCtrlDescriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbDDC_TempCtrlDescript', function (Blueprint $table) {
            $table->string('INVModel',50);
            $table->integer('TempCtrl')->unsigned()->primary();
            $table->string('Descript')->nullable();
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
        Schema::dropIfExists('tbDDC_TempCtrlDescript');
    }
}
