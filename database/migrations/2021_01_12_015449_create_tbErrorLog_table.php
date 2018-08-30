<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbErrorLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbErrorLog', function (Blueprint $table) {
            $table->dateTime('Time');
            $table->integer('UserID')->unsigned();
            $table->foreign('UserID')->references('UserID')->on('tbUserID');
            $table->integer('MBxID');
            $table->integer('PCsID');
            $table->string('SerialNo',50);
            $table->string('ErrorCode',10);
            $table->foreign('ErrorCode')->references('ErrorCode')->on('tbErrorDescript');
            $table->time('Duration')->nullable();
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
        Schema::dropIfExists('tbErrorLog');
    }
}
