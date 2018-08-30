<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDDCStatusDescriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbDDCStatusDescript', function (Blueprint $table) {
            $table->string('INVModel',50);
            $table->integer('Status')->unsigned()->primary();
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
        Schema::dropIfExists('tbDDCStatusDescript');
    }
}
