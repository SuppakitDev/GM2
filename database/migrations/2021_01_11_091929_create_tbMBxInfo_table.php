<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbMBxInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbMBxInfo', function (Blueprint $table) {
            $table->dateTime('Time');            
            $table->integer('UserID')->unsigned();
            $table->foreign('UserID')->references('UserID')->on('tbUserID');
            $table->integer('MBxID');
            $table->integer('SRI')->nullable();
            $table->decimal('OutsideTemp',18,2)->nullable();
            $table->string('ErrorCode',10);
            $table->foreign('ErrorCode',10)->references('ErrorCode')->on('tbErrorDescript');
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
        Schema::dropIfExists('tbMBxInfo');
    }
}
