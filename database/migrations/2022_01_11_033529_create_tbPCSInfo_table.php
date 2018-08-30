<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPCSInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbPCSInfo', function (Blueprint $table) {
            $table->dateTime('Time');
            $table->integer('UserID')->unsigned();
            $table->foreign('UserID')->references('UserID')->on('tbUserID');
            $table->integer('MBxID');
            $table->integer('PcsID');
            $table->string('SerialNo',50);
            $table->string('ErrorCode',10);
            $table->foreign('ErrorCode')->references('ErrorCode')->on('tbErrorDescript');
            $table->integer('PcsStatus')->unsigned();
            $table->foreign('PcsStatus')->references('Status')->on('tbPcsStatusDescript');            
            $table->decimal('Vac',18,1)->nullable();
            $table->decimal('Lac',18,2)->nullable();
            $table->decimal('Pac',18,2)->nullable();
            $table->decimal('AcFreq',18,2)->nullable();
            $table->decimal('AdcBus',18,1)->nullable();
            $table->integer('PCtrlRate')->nullable();
            $table->integer('PSuppression')->unsigned()->nullable();
            $table->foreign('PSuppression')->references('SupressionStatus')->on('tbSuppressionDescript');                                    
            $table->integer('VSuppression')->unsigned()->nullable();
            $table->foreign('VSuppression')->references('SupressionStatus')->on('tbSuppressionDescript');                        
            $table->integer('TempSuppression')->unsigned()->nullable();
            $table->foreign('TempSuppression')->references('SupressionStatus')->on('tbSuppressionDescript');                                    
            $table->decimal('PConsumption',18,0)->nullable();
            $table->decimal('INVTemp',18,2)->nullable();
            $table->integer('NumberOfString')->nullable();            
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
        Schema::dropIfExists('tbPCSInfo');
    }
}
