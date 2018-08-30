<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSuppressionDescriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbSuppressionDescript', function (Blueprint $table) {
            $table->string('INVModel',50);
            $table->integer('SupressionStatus')->unsigned()->primary();
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
        Schema::dropIfExists('tbSuppressionDescript');
    }
}
