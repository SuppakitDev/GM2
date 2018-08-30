<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPVinputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbPVinput', function (Blueprint $table) {
            $table->dateTime('Time');
            $table->integer('UserID')->unsigned();
            $table->foreign('UserID')->references('UserID')->on('tbUserID');
            $table->integer('MBxID');
            $table->integer('PcsID');
            $table->string('SerialNo',50);
            $table->integer('StringNo');
            $table->string('ErrorCode',10);
            $table->foreign('ErrorCode')->references('ErrorCode')->on('tbErrorDescript');            
            $table->integer('Status')->unsigned();
            $table->foreign('Status')->references('Status')->on('tbDDCStatusDescript');            
            $table->integer('TempCtrl')->unsigned();
            $table->foreign('TempCtrl')->references('TempCtrl')->on('tbDDC_TempCtrlDescript');                        
            $table->integer('VCtrl')->unsigned();
            $table->foreign('VCtrl')->references('VCtrl')->on('tbDDC_VCtrlDescript');                                    
            $table->decimal('Vdc',18,1);
            $table->decimal('Power',18,1);            
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
        Schema::dropIfExists('tbPVinput');
    }
}
